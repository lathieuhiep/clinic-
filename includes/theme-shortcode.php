<?php
// short code title has icon
add_shortcode('title_has_icon' , 'clinic_title_has_icon');
function clinic_title_has_icon ($args): false|string {
	ob_start();
	?>
    <div class="title-has-icon">
        <div class="title-has-icon__image">
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-title.webp' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="40" height="40"/>
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

// short code blur image
add_shortcode('blur_image', 'clinic_shortcode_blur_image');
function clinic_shortcode_blur_image($atts): bool|string {
    ob_start();

    $atts = shortcode_atts(
        array(
            'src' => '',
            'alt' => '',
        ),
        $atts,
        'blur_image'
    );
    ?>
    <div class="blur-image">
        <div class="blur-image__box">
            <img src="<?php echo esc_url( $atts['src'] ); ?>" alt="<?php echo esc_attr($atts['alt']); ?>">

            <p class="txt"><?php esc_html_e('Chạm vào để xem ảnh', 'clinic'); ?></p>
        </div>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

//
// Hook to add buttons to TinyMCE
add_action('admin_init', 'clinic_custom_tinymce_buttons');

function clinic_custom_tinymce_buttons(): void
{
    add_filter("mce_external_plugins", "clinic_add_tinymce_plugins");
    add_filter('mce_buttons', 'clinic_register_tinymce_buttons');
}

function clinic_add_tinymce_plugins($plugin_array) {
    $url_admin_scrip = '/assets/admin/js/admin.js';

    $plugin_array['custom_button_title'] = get_theme_file_uri( $url_admin_scrip );
    $plugin_array['custom_button_contact'] = get_theme_file_uri( $url_admin_scrip );
    $plugin_array['custom_button_blur_image'] = get_theme_file_uri( $url_admin_scrip );

    return $plugin_array;
}

function clinic_register_tinymce_buttons($buttons) {
    $buttons[] = "custom_button_title";
    $buttons[] = "custom_button_contact";
    $buttons[] = "custom_button_blur_image";

    return $buttons;
}