<?php

use JetBrains\PhpStorm\NoReturn;

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
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/doctor-slider.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/gallery-grid-box.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/category-list.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/group-button-contact.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/commitment.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/safety-principles.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-list.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/number-list-content.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/list-box-content.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-us.php' );

	// register add on
    $widgets_manager->register( new \Clinic_Elementor_Slider() );
    $widgets_manager->register( new \Clinic_Elementor_About_Us() );
    $widgets_manager->register( new \Clinic_Elementor_Doctor_Slider() );
    $widgets_manager->register( new \Clinic_Elementor_Gallery_Grid_Box() );
    $widgets_manager->register( new \Clinic_Elementor_Category_List() );
    $widgets_manager->register( new \Clinic_Elementor_Group_Button_Contact() );
    $widgets_manager->register( new \Clinic_Elementor_Commitment() );
    $widgets_manager->register( new \Clinic_Elementor_Safety_Principles() );
    $widgets_manager->register( new \Clinic_Elementor_Testimonial_Slider() );
    $widgets_manager->register( new \Clinic_Elementor_Post_Grid() );
    $widgets_manager->register( new \Clinic_Elementor_Contact_List() );
    $widgets_manager->register( new \Clinic_Elementor_Number_List_Content() );
    $widgets_manager->register( new \Clinic_Elementor_List_Box_Content() );
    $widgets_manager->register( new \Clinic_Elementor_Contact_Form_7() );
    $widgets_manager->register( new \Clinic_Elementor_Contact_Us() );
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

		// url ajax
		$clinic_element_admin_url_ajax = admin_url('admin-ajax.php');

		wp_enqueue_script( 'owl.carousel.min', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'clinic-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.min.js' ), array( 'jquery' ), '1.0.0', true );
		wp_localize_script('clinic-elementor-script', 'clinicElementAjax', array('url' => $clinic_element_admin_url_ajax));
	}
}

function addZeroBeforeNumber(int $number): int|string {
	if ( $number < 10 ) {
		return '0' . $number;
	}

	return $number;
}

// ajax get doctor detail
#[NoReturn] function clinic_elementor_ajax_doctor_detail(): void {
	$id = $_POST['postId'];

	ob_start();

	$title = esc_html__( 'Thông tin bác sĩ', 'clinic' );

	if ( $id &  is_numeric( $id) ) :
		$args = array(
			'post_type' => 'clinic_doctor',
            'post__in' => array( intval($id) ),
		);

		$query = new WP_Query( $args );

        if ( $query->have_posts() ) :
	?>
        <div class="modal-body__list">
            <?php
            while ( $query->have_posts() ) :
	            $query->the_post();

	            $title = get_the_title();
	            $specialist = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_specialist', true);
	            $treatment_of = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_treatment_of', true);
            ?>
                <div class="item">
                    <div class="item__top">
                        <div class="icon-thumbnail">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/introducing.png' ) ) ?>" alt="" width="30" height="30">
                        </div>

                        <h4 class="heading">
                            <?php esc_html_e('Giới thiệu', 'clinic'); ?>
                        </h4>
                    </div>

                    <div class="item__body">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="item">
                    <div class="item__top">
                        <div class="icon-thumbnail">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/specialist.png' ) ) ?>" alt="" width="30" height="30">
                        </div>

                        <h4 class="heading">
                            <?php esc_html_e('Chuyên khoa', 'clinic'); ?>
                        </h4>
                    </div>

                    <div class="item__body">
                        <?php echo wpautop( $specialist ); ?>
                    </div>
                </div>

                <div class="item">
                    <div class="item__top">
                        <div class="icon-thumbnail">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/treatment-of.png' ) ) ?>" alt="" width="30" height="30">
                        </div>

                        <h4 class="heading">
                            <?php esc_html_e('Khám và điều trị các bệnh', 'clinic'); ?>
                        </h4>
                    </div>

                    <div class="item__body">
                        <?php echo wpautop( $treatment_of ); ?>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

    <?php else: ?>
        <p class="text-center"><?php echo esc_html( $title ); ?></p>
    <?php
        endif;
    else :
    ?>
        <p class="text-center"><?php echo esc_html( $title ); ?></p>
    <?php
	endif;

	$html = ob_get_clean();

	wp_send_json_success([
        'title' => $title,
        'html' => $html
    ]);

	wp_die();
}
add_action('wp_ajax_clinic_elementor_ajax_doctor_detail', 'clinic_elementor_ajax_doctor_detail');
add_action('wp_ajax_nopriv_clinic_elementor_ajax_doctor_detail', 'clinic_elementor_ajax_doctor_detail');
