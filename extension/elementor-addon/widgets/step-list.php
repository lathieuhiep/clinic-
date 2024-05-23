<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Step_List extends Widget_Base
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
        return 'clinic-step-list';
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
        return esc_html__('Danh sách các bước', 'clinic');
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
        return ['step', 'list'];
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
            'column',
            [
                'label' => esc_html__( 'Cột', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 2,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
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
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-step-list' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-step-list' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // list content
        $this->start_controls_section(
            'list_section',
            [
                'label' => esc_html__( 'Danh sách', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tiêu đề' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'clinic' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Tiêu đề #1', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #2', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #3', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #4', 'clinic' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // style number
        $this->start_controls_section(
            'style_number_section',
            [
                'label' => esc_html__( 'Số', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .element-step-list .number',
            ]
        );

        $this->end_controls_section();

        // style title
        $this->start_controls_section(
            'style_title_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_title_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'selector' => '{{WRAPPER}} .element-step-list .title',
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
            'list_content_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_content_typography',
                'selector' => '{{WRAPPER}} .element-step-list .content',
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

        if ( empty( $settings['list'] ) ) :
            return;
        endif;
    ?>
        <div class="element-step-list">
            <?php foreach ( $settings['list'] as $key => $item ) : ?>
                <div class="item repeater-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <div class="number">
                        <?php echo esc_html( $key + 1 ); ?>
                    </div>

                    <div class="body-box">
                        <?php if ( $item['list_title'] ) : ?>
                            <h3 class="title">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( $item['list_content'] ) : ?>
                            <div class="content">
                                <?php echo wpautop( $item['list_content'] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    }
}