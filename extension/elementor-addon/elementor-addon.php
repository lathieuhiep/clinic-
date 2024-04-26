<?php
// Register Category Elementor Addon
use Elementor\Plugin;

// create category
add_action( 'elementor/elements/categories_registered', 'clinic_add_elementor_widget_categories' );
function clinic_add_elementor_widget_categories( $elements_manager ): void {
	$elements_manager->add_category(
		'my-theme',
		[
			'title' => esc_html__( 'My Theme', 'clinic' ),
			'icon'  => 'icon-goes-here',
		]
	);
}

// Register widgets
add_action( 'elementor/widgets/register', 'clinic_register_widget_elementor_addon' );
function clinic_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-us.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-box-grid.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/specialist.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-grid-gallery.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/gallery-grid-box.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/heading-under-background.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-box-list.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-box-content-list.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/Image-btn-schedule-consultation.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/step-image-box.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-content-list.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/number-list-content.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/heading-between-line.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/circle-box-image.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-content-grid.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/carousel-multiple-rows.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/box-content-line.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/doctor-slider.php' );

	// register add on
	$widgets_manager->register( new \Clinic_Elementor_Addon_Contact_Form_7() );
	$widgets_manager->register( new \Clinic_Elementor_Contact_Us() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Box_Grid() );
	$widgets_manager->register( new \Clinic_Elementor_Specialist() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Grid_Gallery() );
	$widgets_manager->register( new \Clinic_Elementor_Gallery_Grid_Box() );
	$widgets_manager->register( new \Clinic_Elementor_Heading_Under_Background() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Box_List() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Box_Content_List() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Btn_Schedule_Consultation() );
	$widgets_manager->register( new \Clinic_Elementor_Step_Image_Box() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Content_List() );
	$widgets_manager->register( new \clinic_Elementor_Addon_Testimonial_Slider() );
	$widgets_manager->register( new \clinic_Elementor_Addon_Post_Grid() );
	$widgets_manager->register( new \Clinic_Elementor_Number_List_Content() );
	$widgets_manager->register( new \Clinic_Elementor_Heading_Between_Line() );
	$widgets_manager->register( new \Clinic_Elementor_Circle_Box_Image() );
	$widgets_manager->register( new \Clinic_Elementor_Image_Content_Grid() );
	$widgets_manager->register( new \Clinic_Elementor_Carousel_Multiple_Rows() );
	$widgets_manager->register( new \Clinic_Elementor_Box_Content_Line() );
	$widgets_manager->register( new \Clinic_Elementor_Doctor_Slider() );
}

// Register scripts
add_action( 'wp_enqueue_scripts', 'clinic_elementor_scripts', 11 );
function clinic_elementor_scripts(): void {
	$clinic_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $clinic_check_elementor == 'builder' ) {
		// style
		wp_enqueue_style( 'lightslider.min', get_theme_file_uri( '/assets/libs/lightslider/css/lightslider.min.css' ), array(), '1.1.3' );

        wp_enqueue_style( 'clinic-elementor-style', get_theme_file_uri( '/extension/elementor-addon/css/elementor-addon.min.css' ), array(), clinic_get_version_theme() );

		// script
		wp_enqueue_script( 'lightslider.min', get_theme_file_uri( '/assets/libs/lightslider/js/lightslider.min.js' ), array( 'jquery' ), '1.1.3', true );

		wp_enqueue_script( 'clinic-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.js' ), array( 'jquery' ), '1.0.0', true );
	}
}