<?php
// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'clinic_add_arrow',10,4);
function clinic_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"><i class="icon icon-sort-down"></i></span>';
		}
	}

	return $output;
}

// Custom Search Post
add_action( 'pre_get_posts', 'clinic_include_custom_post_types_in_search_results' );
function clinic_include_custom_post_types_in_search_results( $query ): void {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}

//Disable emojis in WordPress
add_action( 'init', 'clinic_disable_emojis' );
function clinic_disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'clinic_disable_emojis_tinymce' );
}

function clinic_disable_emojis_tinymce( $plugins ): array {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// check spam contact form 7
if ( function_exists('wpcf7') ) {
	add_filter('wpcf7_form_elements', 'clinic_check_spam_form_cf7');
	function clinic_check_spam_form_cf7($html): string {
		ob_start();
    ?>
        <div class="d-none">
            <input class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text" name="spam-email" aria-label="">
        </div>
    <?php
        $content = ob_get_contents();
		ob_end_clean();
		return $html . $content;
	}

    // check field spam
	add_action('wpcf7_posted_data', 'clinic_check_spam_form_cf7_valid');
	function clinic_check_spam_form_cf7_valid($posted_data) {
		$submission = WPCF7_Submission::get_instance();
        $note_text = esc_html__('Đã có lỗi xảy ra', 'clinic');

		if ( !empty($posted_data['spam-email']) || !isset($_POST['spam-email'])) {
			$submission->set_status( 'spam' );
			$submission->set_response( $note_text );
		}
		unset($posted_data['spam-email']);
		return $posted_data;
	}

    // validate phone
	add_filter('wpcf7_validate_tel', 'clinic_custom_validate_sdt', 10, 2);
	add_filter('wpcf7_validate_tel*', 'clinic_custom_validate_sdt', 10, 2);
	function clinic_custom_validate_sdt($result, $tag) {
		$name = $tag->name;
		if ($name === 'phone') {
			$sdt = isset($_POST[$name]) ? wp_unslash($_POST[$name]) : '';
			if (!preg_match('/^0([0-9]{9,10})+$/D', $sdt)) {
				$result->invalidate($tag, 'Số điện thoại không hợp lệ.');
			}
		}
		return $result;
	}
}

// add code header
add_action('wp_head', 'clinic_add_code_header');
function clinic_add_code_header(): void {
    $add_code = clinic_get_option( 'opt_add_code_header' );

    if ( $add_code ) {
        echo $add_code;
    }
}

// add code body
add_action('wp_body_open', 'clinic_add_code_body');
function clinic_add_code_body(): void {
    $add_code = clinic_get_option( 'opt_add_code_body' );

    if ( $add_code ) {
        echo $add_code;
    }
}

// javascript footer
add_action('wp_footer', 'clinic_add_script_footer');
function clinic_add_script_footer(): void {
	$add_script = clinic_get_option( 'opt_add_code_footer' );

    if ( $add_script ) {
	    echo $add_script;
    }
}