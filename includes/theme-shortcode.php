<?php
// short code title has icon
add_shortcode('title_has_icon' , 'clinic_title_has_icon');
function clinic_title_has_icon($args) {
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
function clinic_shortcode_contactus() {
	ob_start();

	get_template_part( 'components/inc','single-contact-us', array(
		'class' => 'mt-24 mb-24'
	) );

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// short code