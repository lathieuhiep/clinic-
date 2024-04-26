<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Slider extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-slider';
    }

    public function get_title(): string {
        return esc_html__( 'Slider', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-slider-device';
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
        return ['slider', 'image' ];
    }

    protected function register_controls(): void {

        // Content testimonial
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Sử dụng ảnh ở mục slider trong theme options', 'clinic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $gallery_ids = clinic_get_general_slider();
    ?>

        <div class="element-slider">
            <?php if ( !empty( $gallery_ids ) ) : ?>
                <div class="element-slider__warp owl-carousel owl-theme">
                    <?php foreach ( $gallery_ids as $gallery_item_id ): ?>
                        <div class="item">
                            <?php echo wp_get_attachment_image( $gallery_item_id, 'full' ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    <?php
    }
}