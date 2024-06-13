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

/*
 * short code image overlay
 * */

// Add button to the editor
add_action('media_buttons', 'clinic_button_add_image_overlay');
function clinic_button_add_image_overlay(): void {
	echo '<a href="#" id="btn-add-image-overlay" class="button">'. esc_html__('Thêm Ảnh Làm Mờ', 'clinic') .'</a>';
}

// shortcode image overlay
add_shortcode('image_overlay', 'clinic_image_overlay_shortcode');
function clinic_image_overlay_shortcode ($args): false|string {
	ob_start();
?>
    <div class="image-overlay-box">
        <!-- Your image editor content goes here -->
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