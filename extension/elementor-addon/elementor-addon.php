<?php
function clinic_custom_elementor_content_width(): int
{
    return 1200;
}
add_filter( 'hello_elementor_content_width', 'clinic_custom_elementor_content_width' );

// Register Category Elementor Addon
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
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/about-us.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/category-list.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/gallery-grid-box.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/doctor-slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/space-slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/work-time.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/step-image-box.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/chat-with-us.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/timeline.php' );

//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/company-info.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-box-content-list.php' );



//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/instruct.php' );


//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/grid-text-editor.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/principles.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/compare-appointments.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-us.php' );

	// register add on
    $widgets_manager->register( new \Clinic_Elementor_Slider() );
	$widgets_manager->register( new \Clinic_Elementor_About_Us() );
	$widgets_manager->register( new \Clinic_Elementor_Category_List() );
	$widgets_manager->register( new \Clinic_Elementor_Gallery_Grid_Box() );
	$widgets_manager->register( new \Clinic_Elementor_Doctor_Slider() );
	$widgets_manager->register( new \Clinic_Elementor_Space_Slider() );
	$widgets_manager->register( new \Clinic_Elementor_Work_Time() );
	$widgets_manager->register( new \Clinic_Elementor_Step_Image_Box() );
	$widgets_manager->register( new \Clinic_Elementor_Testimonial_Slider() );
	$widgets_manager->register( new \Clinic_Elementor_Contact_Form_7() );
	$widgets_manager->register( new \Clinic_Elementor_Post_Grid() );
	$widgets_manager->register( new \Clinic_Elementor_Chat_With_Us() );
	$widgets_manager->register( new \Clinic_Elementor_Timeline() );

//    $widgets_manager->register( new \Clinic_Elementor_Company_Info() );
//    $widgets_manager->register( new \Clinic_Elementor_Image_Box_Content_List() );



//    $widgets_manager->register( new \Clinic_Elementor_Instruct() );


//    $widgets_manager->register( new \Clinic_Elementor_Grid_Text_Editor() );
//    $widgets_manager->register( new \Clinic_Elementor_Principles() );

//    $widgets_manager->register( new \Clinic_Elementor_Compare_Appointments() );
//    $widgets_manager->register( new \Clinic_Elementor_Contact_Us() );
}

// Register scripts
add_action( 'wp_enqueue_scripts', 'clinic_elementor_scripts', 11 );
function clinic_elementor_scripts(): void {
	$clinic_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $clinic_check_elementor == 'builder' ) {
		// style
		wp_enqueue_style( 'owl.carousel.min', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.css' ), array(), '2.3.4' );

        wp_enqueue_style( 'clinic-elementor-style', get_theme_file_uri( '/extension/elementor-addon/css/elementor-addon.min.css' ), array(), clinic_get_version_theme() );

		// script
		wp_enqueue_script( 'owl.carousel.min', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'clinic-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.min.js' ), array( 'jquery' ), '1.0.0', true );
	}
}

function addZeroBeforeNumber(int $number): int|string {
	if ( $number < 10 ) {
		return '0' . $number;
	}

	return $number;
}