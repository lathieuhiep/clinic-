<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Working_Time extends Widget_Base
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
        return 'clinic-working-time';
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
        return esc_html__('Thời gian làm việc', 'clinic');
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
        return ['time', 'contact'];
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
        // opening hours section
        $this->start_controls_section(
            'opening_hours_section',
            [
                'label' => esc_html__( 'Giờ mở cửa', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'open_hour',
            [
                'label' => esc_html__( 'Giờ', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 24,
                'step' => 1,
                'default' => 8,
            ]
        );

        $this->add_control(
            'open_minute',
            [
                'label' => esc_html__( 'Phút', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 59,
                'step' => 1,
                'default' => 0,
            ]
        );

        $this->end_controls_section();

        // closing time section
        $this->start_controls_section(
            'closing_time_section',
            [
                'label' => esc_html__( 'Giờ đóng cửa', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'close_hour',
            [
                'label' => esc_html__( 'Giờ', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 24,
                'step' => 1,
                'default' => 20,
            ]
        );

        $this->add_control(
            'close_minute',
            [
                'label' => esc_html__( 'Phút', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 59,
                'step' => 1,
                'default' => 0,
            ]
        );

        $this->end_controls_section();

        // phone style section
        $this->start_controls_section(
            'phone_style_section',
            [
                'label' => esc_html__( 'Điện thoại', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'phone_color',
            [
                'label' => esc_html__( 'Màu', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-working-time .hotline-box .phone' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'selector' => '{{WRAPPER}} .element-working-time .hotline-box .phone',
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

        $hotline = clinic_get_opt_hotline();
    ?>
        <div class="element-working-time">
            <div class="time-warp">
                <div class="hour opening-hours">
                    <div class="time">
                        <?php echo esc_html( addZeroBeforeNumber( $settings['open_hour'] ) ); ?>
                    </div>

                    <div class="time">
                        <?php echo esc_html( addZeroBeforeNumber( $settings['open_minute'] ) ); ?>
                    </div>
                </div>

                <div class="line"></div>

                <div class="hour closing-time">
                    <div class="time">
                        <?php echo esc_html( addZeroBeforeNumber( $settings['close_hour'] ) ); ?>
                    </div>

                    <div class="time">
                        <?php echo esc_html( addZeroBeforeNumber( $settings['close_minute'] ) ); ?>
                    </div>
                </div>
            </div>

            <?php if ( $hotline ) : ?>
                <div class="hotline-box">
                    <h3 class="title">
                        <?php esc_html_e( 'Hotline tư vấn', 'clinic' ); ?>
                    </h3>

                    <a class="phone" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                        <?php echo esc_html( $hotline ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}