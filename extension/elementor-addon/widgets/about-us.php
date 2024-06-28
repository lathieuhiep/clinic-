<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_About_Us extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'clinic-about-us';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Về chúng tôi', 'clinic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string {
        return 'eicon-text';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['about us', 'text'];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['my-theme'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @access protected
     */
    protected function register_controls(): void
    {
        // layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns_grid',
            [
                'label' => esc_html__( 'Cột', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'fr' => [
                        'min' => 1,
                        'max' => 12,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'fr', 'custom' ],
                'unit_selectors_dictionary' => [
                    'custom' => 'grid-template-columns: {{SIZE}}',
                ],
                'default' => [
                    'unit' => 'fr',
                    'size' => 2,
                ],
                'mobile_default' => [
                    'unit' => 'fr',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp' => 'grid-template-columns: repeat({{SIZE}}, 1fr)',
                ],
                'responsive' => true,
                'editor_available' => true,
            ]
        );

        $this->add_responsive_control(
            'grid_column_gap',
            [
                'label' => esc_html__( 'Grid column gap', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_row_gap',
            [
                'label' => esc_html__( 'Grid row gap', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_position',
            [
                'label' => esc_html__( 'Căn chỉnh các mục', 'clinic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Bắt đầu', 'clinic' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Giữa', 'clinic' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Kết thúc', 'clinic' ),
                        'icon' => 'eicon-align-end-v',
                    ],
                    'stretch' => [
                        'title' => esc_html__( 'Nới rộng', 'clinic' ),
                        'icon' => 'eicon-align-stretch-v',
                    ],
                ],
                'default' => 'start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // image
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Hình ảnh', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_responsive_control(
            'image_order',
            [
                'label' => esc_html__( 'Vị trí', 'clinic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( 'Bắt đầu', 'clinic' ),
                        'icon' => 'eicon-order-start',
                    ],
                    '2' => [
                        'title' => esc_html__( 'Kết thúc', 'clinic' ),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item.item-thumbnail' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Chiều rộng ảnh', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item.item-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Trái', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Giữa', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Phải', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' =>  esc_html__( 'Căn đều hai lề', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item.item-thumbnail .box-image' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // heading
        $this->start_controls_section(
            'heading_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tiêu đề', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => esc_html__( 'Tiêu đề dưới', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_dividing_line',
            [
                'label' => esc_html__('Hiển thị đường ngăn cách', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Có', 'clinic'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('Không', 'clinic'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'hide'
            ]
        );

        $this->add_responsive_control(
            'dividing_line_width',
            [
                'label' => esc_html__( 'Độ dài đường ngăn cách', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .dividing-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_dividing_line' => 'show',
                ],
            ]
        );

        $this->add_control(
            'dividing_line_background_color',
            [
                'label'     =>  esc_html__( 'Màu nền đường ngăn cách', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-us__warp .item .dividing-line' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_dividing_line' => 'show',
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( 'Nội dung', 'clinic' ),
            ]
        );

        $this->end_controls_section();

        // contact section
        $this->start_controls_section(
            'contact_section',
            [
                'label' => esc_html__( 'Liên hệ', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_booking',
            [
                'label' => esc_html__('Hiển thị đặt lịch', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Có', 'clinic'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('Không', 'clinic'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );

        $this->add_control(
            'show_chat',
            [
                'label' => esc_html__('Hiển thị chat', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Có', 'clinic'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('Không', 'clinic'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );

        $this->end_controls_section();

        // style heading
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'text-start'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'text-center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'text-end' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'text-justify' => [
                        'title' =>  esc_html__( 'Justify', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'text-start',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Màu', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item .heading',
            ]
        );

        $this->end_controls_section();

        // style sub heading
        $this->start_controls_section(
            'style_sub_heading_section',
            [
                'label' => esc_html__( 'Tiêu đề dưới', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sub_heading_margin',
            [
                'label' => esc_html__( 'Margin', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_heading_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'text-start'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'text-center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'text-end' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],
                    'text-justify' => [
                        'title' =>  esc_html__( 'Justify', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'text-center',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__( 'Màu', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item .sub-heading',
            ]
        );

        $this->end_controls_section();

        // style desc
        $this->start_controls_section(
            'style_desc_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Margin', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__( 'Padding', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_background_color',
            [
                'label' => esc_html__( 'Màu nền', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' =>  esc_html__( 'Justify', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'justify',
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item .desc',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'desc_border',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item .desc',
            ]
        );

        $this->add_control(
            'desc_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item .desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        // theme options
        $link_chat = clinic_get_opt_link_chat_doctor();
        $medical_appointment_form = clinic_get_opt_medical_appointment();
        ?>
        <div class="element-about-us">
            <div class="element-about-us__warp">
                <div class="item item-thumbnail">
                    <div class="box-image">
                        <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                    </div>
                </div>

                <div class="item item-content">
                    <?php if ( $settings['heading'] ) : ?>
                        <h2 class="heading <?php echo esc_attr($settings['heading_align']); ?>">
                            <?php echo wp_kses_post( $settings['heading'] ); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ( $settings['sub_heading'] ) : ?>
                        <h3 class="sub-heading <?php echo esc_attr($settings['sub_heading_align']); ?>">
                            <?php echo esc_html( $settings['sub_heading'] ); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ( $settings['show_dividing_line'] == 'show' ) : ?>
                        <div class="dividing-line"></div>
                    <?php endif; ?>

                    <div class="desc">
                        <?php echo wpautop( $settings['desc'] ); ?>
                    </div>

                    <?php if ( $settings['show_booking'] == 'show' || $settings['show_chat'] == 'show' ) : ?>
                        <div class="action-box d-flex">
                            <?php if ( $settings['show_booking'] == 'show' && $medical_appointment_form ) : ?>
                                <a class="action-box__booking text-uppercase" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                    <?php esc_html_e('Đặt lịch khám', "clinic"); ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( $settings['show_chat'] == 'show' && $link_chat ) : ?>
                                <a class="action-box__chat text-uppercase" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                                    <?php esc_html_e('Gặp bác sĩ', "clinic"); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}