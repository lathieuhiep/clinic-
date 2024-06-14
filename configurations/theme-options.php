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

			// logo mobile
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
		)
	) );

    // Slider
    CSF::createSection( $clinic_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Slider', 'clinic' ),
        'fields' => array(
            array(
                'id'    => 'opt_general_slider',
                'type'  => 'gallery',
                'title' => esc_html__( 'Slider', 'clinic' ),
            ),
        )
    ) );

	// Contact
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_general_section',
		'title'  => esc_html__( 'Giờ làm - Liên hệ', 'clinic' ),
		'fields' => array(
            array(
                'id'      => 'opt_general_address',
                'type'    => 'text',
                'title'   => esc_html__( 'Địa chỉ', 'clinic' ),
                'default' => esc_html__( '180 Trần phú - Phước Ninh', 'clinic' )
            ),

			array(
				'id'      => 'opt_general_working_time',
				'type'    => 'text',
				'title'   => esc_html__( 'Giờ làm việc', 'clinic' ),
				'default' => '08:00 - 20:30'
			),

			array(
				'id'      => 'opt_general_hotline',
				'type'    => 'text',
				'title'   => esc_html__( 'Hotline', 'clinic' ),
				'default' => '0987.851.230'
			),

			array(
				'id'      => 'opt_general_cf',
				'type'    => 'select',
				'title'   => esc_html__( 'Form liên hệ', 'clinic' ),
				'desc'    => esc_html__( 'Hiển thị ở header trên mobile', 'clinic' ),
				'options' => clinic_get_form_cf7(),
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
                'id'      => 'opt_general_chat_doctor',
                'type'    => 'text',
                'title'   => esc_html__( 'Gặp bác sĩ', 'clinic' ),
                'default' => '#',
            ),

            array(
                'id'      => 'opt_general_chat_messenger',
                'type'    => 'text',
                'title'   => esc_html__( 'Link messenger', 'clinic' ),
                'default' => '',
            ),

            array(
                'id'     => 'opt_general_chat_zalo',
                'type'   => 'fieldset',
                'title'  => esc_html__('ZaLo', 'clinic'),
                'fields' => array(
                    // select zalo
                    array(
                        'id'      => 'select_zalo',
                        'type'    => 'select',
                        'title'   => esc_html__( 'Kiểu liên hệ', 'clinic' ),
                        'options' => array(
                            'phone_qr' => esc_html__('Số điện thoại + QR code', 'clinic'),
                            'link' =>  esc_html__('Link Zalo', 'clinic'),
                        ),
                        'default' => 'phone_qr'
                    ),

                    // phone + qrcode
                    array(
                        'id'    => 'phone',
                        'type'  => 'text',
                        'title' => esc_html__( 'Số điện thoại', 'clinic' ),
                        'default' => '0827.764.988',
                        'dependency' => array( 'select_zalo', '==', 'phone_qr' )
                    ),

                    array(
                        'id'    => 'qr_code',
                        'type'  => 'text',
                        'title' => esc_html__( 'Mã QR', 'clinic' ),
                        'default' => '1dih4viqk5rpm',
                        'desc' => esc_html__('Link quét lấy mã:', 'clinic') . ' https://pageloot.com/vi/quet-ma-qr/',
                        'dependency' => array( 'select_zalo', '==', 'phone_qr' )
                    ),

                    // link
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__( 'Link', 'clinic' ),
                        'default' => 'https://zalo.me/4019565536704794124',
                        'dependency' => array( 'select_zalo', '==', 'link' ),
                    ),
                ),
            ),

            array(
                'id'      => 'opt_general_chat_qr_code_zalo',
                'type'    => 'media',
                'title'   => esc_html__( 'QR code ZaLo', 'clinic' ),
                'library' => 'image',
                'url'     => false
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
				'text_on'    => esc_html__( 'Có', 'clinic' ),
				'text_off'   => esc_html__( 'Không', 'clinic' ),
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
		'title' => esc_html__( 'Bài viết', 'clinic' ),
	) );

	// Category Post
	CSF::createSection( $clinic_prefix, array(
		'parent'      => 'opt_post_section',
		'title'       => esc_html__( 'Danh mục', 'clinic' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'clinic' ),
		'fields'      => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Vị trí sidebar', 'clinic' ),
				'options' => array(
					'hide'  => esc_html__( 'Ẩn', 'clinic' ),
					'left'  => esc_html__( 'Trái', 'clinic' ),
					'right' => esc_html__( 'Phải', 'clinic' ),
				),
				'default' => 'right'
			),

            // layout
            array(
                'id'        => 'opt_post_cat_grid',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Grid', 'clinic' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
                        'default'    => 4,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'clinic' ),
                        'default'    => 4,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
            ),
		)
	) );

	// Single Post
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Bài viết chi tiết', 'clinic' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Vị trí sidebar', 'clinic' ),
                'options' => array(
                    'hide'  => esc_html__( 'Ẩn', 'clinic' ),
                    'left'  => esc_html__( 'Trái', 'clinic' ),
                    'right' => esc_html__( 'Phải', 'clinic' ),
                ),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Hiển thị bài viết liên quan', 'clinic' ),
				'text_on'    => esc_html__( 'Có', 'clinic' ),
				'text_off'   => esc_html__( 'Không', 'clinic' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Số bài viết hiển thị', 'clinic' ),
				'default' => 6,
			),

            // Show contact
            array(
                'id'         => 'opt_post_single_show_contact',
                'type'       => 'switcher',
                'title'      => esc_html__( 'Hiển thị liên hệ', 'clinic' ),
                'text_on'    => esc_html__( 'Có', 'clinic' ),
                'text_off'   => esc_html__( 'Không', 'clinic' ),
                'default'    => false,
                'text_width' => 80
            ),

			array(
				'id'      => 'opt_post_single_contact_form',
				'type'    => 'select',
				'title'   => esc_html__( 'Form liên hệ', 'clinic' ),
				'options' => clinic_get_form_cf7(),
			),
		)
	) );

    //
    // Create a section social network
    CSF::createSection( $clinic_prefix, array(
        'title'  => esc_html__( 'Social Network', 'clinic' ),
        'icon'   => 'fab fa-hive',
        'fields' => array(
            array(
                'id'      => 'opt_social_network',
                'type'    => 'repeater',
                'title'   => esc_html__( 'Mạng xã hội', 'clinic' ),
                'fields'  => array(
                    array(
                        'id'      => 'icon',
                        'type'    => 'media',
                        'title'   => esc_html__( 'Icon', 'clinic' ),
                        'library' => 'image',
                        'url'     => false
                    ),

                    array(
                        'id'    => 'url',
                        'type'  => 'text',
                        'title' => esc_html__('URL', 'clinic'),
                        'default' => '#'
                    ),
                ),
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
                'id'        => 'opt_footer_column_width_1',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 1', 'clinic' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', '!=', '0' )
            ),

            // column width 2
            array(
                'id'        => 'opt_footer_column_width_2',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 2', 'clinic' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
            ),

            // column width 3
            array(
                'id'        => 'opt_footer_column_width_3',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'clinic' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
            ),

            // column width 4
            array(
                'id'        => 'opt_footer_column_width_4',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'clinic' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'clinic' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'clinic' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'clinic' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
            ),
        )
    ) );

    //
    // -> Create a section add code
    CSF::createSection( $clinic_prefix, array(
        'id'    => 'opt_add_code_section',
        'icon'  => 'fas fa-stream',
        'title' => esc_html__( 'Thêm code', 'clinic' ),
    ) );

    // add code header
    CSF::createSection( $clinic_prefix, array(
        'parent' => 'opt_add_code_section',
        'title'  => esc_html__( 'Thêm vào header', 'clinic' ),
        'fields' => array(
            array(
                'id'       => 'opt_add_code_header',
                'type'     => 'code_editor',
                'title'    => esc_html__('Code', 'clinic'),
                'sanitize' => false,
                'settings' => array(
                    'theme'  => 'monokai'
                ),
            ),
        )
    ) );

	// add code footer
	CSF::createSection( $clinic_prefix, array(
		'parent' => 'opt_add_code_section',
		'title'  => esc_html__( 'Thêm vào footer', 'clinic' ),
		'fields' => array(
			array(
				'id'       => 'opt_add_code_footer',
				'type'     => 'code_editor',
				'title'    => esc_html__('Code', 'clinic'),
				'sanitize' => false,
				'settings' => array(
					'theme'  => 'monokai'
				),
			),
		)
	) );
}