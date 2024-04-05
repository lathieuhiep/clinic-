<?php
// A Custom function for get an option
if ( ! function_exists( 'clinic_get_option' ) ) {
	function clinic_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$clinic_prefix   = 'options';
	$clinic_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $clinic_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'clinic' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $clinic_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'clinic' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'clinic' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	//
	// -> Create a section general
	CSF::createSection( $clinic_prefix, array(
		'id'    => 'opt_general_section',
		'title' => esc_html__( 'Cài đặt chung', 'clinic' ),
		'icon'  => 'fas fa-cog'
	) );

	// Global
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_general_section',
		'title'  => esc_html__( 'Toàn cục', 'clinic' ),
		'fields' => array(
			// favicon
			array(
				'id'      => 'opt_general_favicon',
				'type'    => 'media',
				'title'   => esc_html__( 'Favicon', 'clinic' ),
				'library' => 'image',
				'url'     => false
			),

			// logo
			array(
				'id'      => 'opt_general_logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Logo', 'clinic' ),
				'library' => 'image',
				'url'     => false
			),

			// logo
			array(
				'id'      => 'opt_general_logo_mobile',
				'type'    => 'media',
				'title'   => esc_html__( 'Logo Mobile', 'clinic' ),
				'library' => 'image',
				'url'     => false
			),

			// show loading
			array(
				'id'         => 'opt_general_loading',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Chờ tải trang', 'clinic' ),
				'text_on'    => esc_html__( 'Có', 'clinic' ),
				'text_off'   => esc_html__( 'Không', 'clinic' ),
				'text_width' => 80,
				'default'    => false
			),

			array(
				'id'         => 'opt_general_image_loading',
				'type'       => 'media',
				'title'      => esc_html__( 'Image Loading', 'clinic' ),
				'subtitle'   => esc_html__( 'Use file .git', 'clinic' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
				'dependency' => array( 'opt_general_loading', '==', 'true' ),
				'url'        => false
			),

			// show back to top
			array(
				'id'         => 'opt_general_back_to_top',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Quay về đầu trang', 'clinic' ),
				'text_on'    => esc_html__( 'Có', 'clinic' ),
				'text_off'   => esc_html__( 'Không', 'clinic' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	// Contact
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_general_section',
		'title'  => esc_html__( 'Giờ làm - Liên hệ', 'clinic' ),
		'fields' => array(
			array(
				'id'      => 'opt_general_working_time',
				'type'    => 'text',
				'title'   => esc_html__( 'Giờ làm việc', 'clinic' ),
				'default' => '7:30 - 20:00'
			),

			array(
				'id'     => 'opt_general_hotline',
				'type'   => 'repeater',
				'title'  => esc_html__( 'Hotline Group', 'clinic' ),
				'fields' => array(
					array(
						'id'    => 'phone',
						'type'  => 'text',
						'title' => esc_html__( 'Điện thoại', 'clinic' ),
					),
				),

				'default' => array(
					array(
						'phone' => '0888.888.115',
					),

					array(
						'phone' => '024.888.11115',
					)
				)
			),

			array(
				'id'      => 'opt_general_hotline_mobile',
				'type'    => 'text',
				'title'   => esc_html__( 'Hotline', 'clinic' ),
				'default' => '0888.888.115'
			),

			array(
				'id'      => 'opt_general_cf',
				'type'    => 'select',
				'title'   => esc_html__( 'Form liên hệ', 'clinic' ),
				'desc'    => esc_html__( 'Hiển thị ở header trên mobile', 'clinic' ),
				'options' => clinic_get_form_cf7(),
			),

			array(
				'id'      => 'opt_general_chat_doctor',
				'type'    => 'text',
				'title'   => esc_html__( 'Gặp bác sĩ', 'clinic' ),
				'default' => '#',
			),

			array(
				'id'      => 'opt_general_medical_appointment_form',
				'type'    => 'select',
				'title'   => esc_html__( 'Form hẹn khám', 'clinic' ),
				'desc'    => esc_html__( 'Hiển thị khi click button hẹn khám', 'clinic' ),
				'options' => clinic_get_form_cf7(),
			),
		)
	) );

    // chat with us
    CSF::createSection( $clinic_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Chat với chúng tôi', 'clinic' ),
        'fields' => array(
            array(
                'id'     => 'opt_general_chat_zalo',
                'type'   => 'fieldset',
                'title'  => esc_html__('ZaLo', 'clinic'),
                'fields' => array(
                    array(
                        'id'    => 'phone',
                        'type'  => 'text',
                        'title' => esc_html__( 'Số điện thoại', 'clinic' ),
                        'default' => '0888888115',
                    ),

                    array(
                        'id'    => 'qr_code',
                        'type'  => 'text',
                        'title' => esc_html__( 'Mã QR', 'clinic' ),
                        'default' => 'i44981jfbz1g',
                        'desc' => esc_html__('Link quét lấy mã:', 'clinic') . ' https://pageloot.com/vi/quet-ma-qr/'
                    ),
                ),
            ),
        )
    ) );

	//
	// Create a section menu
	CSF::createSection( $clinic_prefix, array(
		'title'  => esc_html__( 'Menu', 'clinic' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'clinic' ),
				'text_on'    => esc_html__( 'Yes', 'clinic' ),
				'text_off'   => esc_html__( 'No', 'clinic' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $clinic_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'clinic' ),
	) );

	// Category Post
	CSF::createSection( $clinic_prefix, array(
		'parent'      => 'opt_post_section',
		'title'       => esc_html__( 'Category', 'clinic' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'clinic' ),
		'fields'      => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'clinic' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'clinic' ),
					'left'  => esc_html__( 'Left', 'clinic' ),
					'right' => esc_html__( 'Right', 'clinic' ),
				),
				'default' => 'right'
			),
		)
	) );

	// Single Post
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'clinic' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'clinic' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'clinic' ),
					'left'  => esc_html__( 'Left', 'clinic' ),
					'right' => esc_html__( 'Right', 'clinic' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'clinic' ),
				'text_on'    => esc_html__( 'Yes', 'clinic' ),
				'text_off'   => esc_html__( 'No', 'clinic' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'clinic' ),
				'default' => 6,
			),
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $clinic_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'clinic' ),
	) );

	// footer columns
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Columns Sidebar', 'clinic' ),
		'fields' => array(
			// select columns
			array(
				'id'      => 'opt_footer_columns',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of footer columns', 'clinic' ),
				'options' => array(
					'0' => esc_html__( 'Hide', 'clinic' ),
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
				'default' => '4'
			),

			// column width 1
			array(
				'id'         => 'opt_footer_column_width_1',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 1', 'clinic' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 2', 'clinic' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 3', 'clinic' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 4', 'clinic' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );

	// add javascript
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Thêm mã javascript', 'clinic' ),
		'fields' => array(
			array(
				'id'       => 'opt_footer_add_javascript',
				'type'     => 'code_editor',
				'title'    => esc_html__('Code', 'clinic'),
				'sanitize' => false,
				'settings' => array(
					'theme'  => 'monokai',
					'mode'   => 'javascript',
				),
			),
		)
	) );
}