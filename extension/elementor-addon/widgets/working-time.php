<?php

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Working_Time extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-working-time';
    }

    public function get_title(): string {
        return esc_html__( 'Thời gian hoạt động', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-countdown';
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
        return ['time', 'working' ];
    }

    protected function register_controls(): void {

        // open time section
        $this->start_controls_section(
            'open_time_section',
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
                'default' => 7,
            ]
        );

        $this->add_control(
            'open_minutes',
            [
                'label' => esc_html__( 'Phút', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 59,
                'step' => 1,
                'default' => 30,
            ]
        );

        $this->end_controls_section();

        // close time section
        $this->start_controls_section(
            'close_time_section',
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
            'close_minutes',
            [
                'label' => esc_html__( 'Phút', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 59,
                'step' => 1,
                'default' => 30,
            ]
        );

        $this->end_controls_section();

        // content
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content',
            [
                'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( '(Làm việc cả thứ 7, chủ nhật và các ngày lễ tết)', 'clinic' ),
            ]
        );

        $this->end_controls_section();

        // time style
        $this->start_controls_section(
            'time_style_section',
            [
                'label' => esc_html__( 'Thời gian', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'time_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-working-time__warp .time span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'time_background_color',
            [
                'label' => esc_html__( 'Màu nền', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-working-time__warp .time span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_typography',
                'selector' => '{{WRAPPER}} .element-working-time__warp .time span',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'time_border',
                'selector' => '{{WRAPPER}} .element-working-time__warp .time span',
            ]
        );

        $this->end_controls_section();

        // line style
        $this->start_controls_section(
            'line_style_section',
            [
                'label' => esc_html__( 'Dấu gạch', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'line_background_color',
            [
                'label' => esc_html__( 'Màu nền', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-working-time__warp .chart' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'line_border',
                'selector' => '{{WRAPPER}} .element-working-time__warp .chart',
            ]
        );

        $this->end_controls_section();

        // content style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-working-time .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .element-working-time .content',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>

    <div class="element-working-time">
        <div class="element-working-time__warp">
            <div class="time open">
                <span class="hour"><?php echo esc_html( $settings['open_hour'] ) ?></span>

                <span class="minutes"><?php echo esc_html( addZeroBeforeNumber( $settings['open_minutes'] ) ); ?></span>
            </div>

            <div class="chart"></div>

            <div class="time close">
                <span class="hour"><?php echo esc_html( $settings['close_hour'] ) ?></span>

                <span class="hour"><?php echo esc_html( addZeroBeforeNumber( $settings['close_minutes'] ) ); ?></span>
            </div>
        </div>

        <div class="content text-center">
            <?php echo wpautop( $settings['content'] ); ?>
        </div>
    </div>

    <?php
    }
}