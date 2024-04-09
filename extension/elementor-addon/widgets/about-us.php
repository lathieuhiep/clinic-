<?php

use Elementor\Controls_Manager;
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
        return ['about', 'text'];
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
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'clinic' ),
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
            'heading',
            [
                'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'PHÒNG KHÁM ĐA KHOA QUỐC TẾ ĐÀ NẴNG', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => esc_html__( 'Tiêu đề dưới', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tạo dựng niềm tin bằng chất lượng', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( 'Phòng khám Đa khoa Quốc tế Đà Nẵng', 'clinic' ),
            ]
        );

        $this->end_controls_section();

        // style heading
        $this->start_controls_section(
            'style_heading_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Color', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item__heading',
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

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__( 'Color', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item__sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item__sub-heading',
            ]
        );

        $this->end_controls_section();

        // style content
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Color', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-about-us__warp .item__desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .element-about-us__warp .item__desc',
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
    ?>
        <div class="element-about-us">
            <div class="element-about-us__warp">
                <div class="item">
                    <div class="item__thumbnail text-center">
                        <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                    </div>
                </div>

                <div class="item">
                    <?php if ( $settings['heading'] ) : ?>
                        <h2 class="item__heading text-center">
                            <?php echo esc_html( $settings['heading'] ); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ( $settings['sub_heading'] ) : ?>
                        <h3 class="item__sub-heading">
                            <span class="line"></span>
                            <span class="text"><?php echo esc_html( $settings['sub_heading'] ); ?></span>
                            <span class="line"></span>
                        </h3>
                    <?php endif; ?>

                    <div class="item__desc text-justify">
                        <?php echo wpautop( $settings['desc'] ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}