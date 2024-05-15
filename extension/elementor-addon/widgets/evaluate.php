<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Evaluate extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-evaluate';
    }

    public function get_title(): string {
        return esc_html__( 'Đánh giá', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-facebook-like-box';
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
        return ['evaluate', 'image' ];
    }

    protected function register_controls(): void {

        // heading section
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

        $this->end_controls_section();

        // image section
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
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

        // list section
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
                'default' => esc_html__( 'List Title' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Danh sách', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'clinic' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'clinic' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // heading style
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Màu', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-evaluate__item .heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-evaluate__item .heading',
            ]
        );

        $this->end_controls_section();

        // sub heading style
        $this->start_controls_section(
            'sub_heading_style_section',
            [
                'label' => esc_html__( 'Tiêu đề dưới', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__( 'Màu', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-evaluate__item .sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .element-evaluate__item .sub-heading',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="element-evaluate">
            <div class="element-evaluate__item">
                <h2 class="heading">
                    <?php echo esc_html( $settings['heading'] ); ?>
                </h2>

                <h3 class="sub-heading">
                    <?php echo esc_html( $settings['sub_heading'] ); ?>
                </h3>

                <?php if (!empty($settings['list'])) : ?>
                    <ul class="list reset-list">
                        <?php foreach ($settings['list'] as $item) : ?>
                            <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                                <i class="icon icon-star"></i>
                                <span class="txt"><?php echo esc_html( $item['list_title'] ) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="element-evaluate__item">
                <div class="image-box">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                </div>
            </div>
        </div>
    <?php
    }
}