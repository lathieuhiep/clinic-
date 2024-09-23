<?php
// short code title has icon
add_shortcode('title_has_icon' , 'clinic_title_has_icon');
function clinic_title_has_icon ($args): false|string {
	ob_start();
	?>
	<div class="title-has-icon">
		<div class="title-has-icon__image">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-title.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="40" height="40"/>
		</div>

		<h2 class="title-has-icon__text"><?php echo esc_html( $args['title'] ); ?></h2>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// short code contact us
add_shortcode('single_contact_us' , 'clinic_shortcode_contactus');
function clinic_shortcode_contactus(): bool|string {
	ob_start();

	get_template_part( 'components/inc','post-contact-us' );

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// Hook to add buttons to TinyMCE
add_action('admin_init', 'clinic_custom_tinymce_buttons');

function clinic_custom_tinymce_buttons(): void
{
    add_filter("mce_external_plugins", "clinic_add_tinymce_plugins");
    add_filter('mce_buttons', 'clinic_register_tinymce_buttons');
}

function clinic_add_tinymce_plugins($plugin_array) {
    // Đảm bảo đường dẫn tới file JS chính xác
    $plugin_array['custom_button_title'] = get_theme_file_uri( '/assets/admin/admin.js' );
    $plugin_array['custom_button_contact'] = get_theme_file_uri( '/assets/admin/admin.js' );
    return $plugin_array;
}

function clinic_register_tinymce_buttons($buttons) {
    $buttons[] = "custom_button_title";
    $buttons[] = "custom_button_contact";

    return $buttons;
}