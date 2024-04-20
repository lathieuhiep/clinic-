<?php
// setting favicon
add_action('wp_head', 'clinic_favicon', 1);
function clinic_favicon(): void {
    $opt_favicon = clinic_get_option( 'opt_general_favicon' );

    if ( empty( $opt_favicon['url'] ) ) :
        $favicon_url = get_theme_file_uri('/assets/images/favicon.png' );
    else:
	    $favicon_url = $opt_favicon['url'];
    endif;

    echo '<link rel="shortcut icon" href="' . esc_url( $favicon_url ) . '" type="image/x-icon" sizes="16x16" />';
}

// add property
add_action( 'wp_head', 'clinic_opengraph', 5 );
function clinic_opengraph(): void {
	global $post;

	if ( is_single() ) :
		if ( has_post_thumbnail( $post->ID ) ) :
			$img_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		else :
			$img_src = get_theme_file_uri( '/images/no-image.png' );
		endif;

		$excerpt = $post->post_excerpt;

		if ( $excerpt ) :
			$excerpt = strip_tags( $post->post_excerpt );
			$excerpt = str_replace( "", "'", $excerpt );
		else :
			$excerpt = get_bloginfo( 'description' );
		endif;

		?>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>" />
		<meta property="og:image" content="<?php echo esc_url( $img_src ); ?>" />
	<?php
	endif;
}

// Sanitize Pagination
add_action( 'navigation_markup_template', 'clinic_sanitize_pagination' );
function clinic_sanitize_pagination( $clinic_content ): string {
	// Remove role attribute
	$clinic_content = str_replace( 'role="navigation"', '', $clinic_content );

	// Remove h2 tag
	return preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $clinic_content );
}

// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'clinic_add_arrow',10,4);
function clinic_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"><i class="fa-solid fa-chevron-down"></i></span>';
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
function clinic_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'clinic_disable_emojis_tinymce' );
}

function clinic_disable_emojis_tinymce( $plugins ) {
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

// javascript footer
add_action('wp_footer', 'clinic_add_script_footer');
function clinic_add_script_footer(): void {
	$add_script = clinic_get_option( 'opt_footer_add_javascript' );

    if ( $add_script ) {
	    echo $add_script;
    }
}