<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Heading_And_Sub extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-heading-and-sub';
    }

    public function get_title(): string {
        return esc_html__( 'Tiêu đề chính và phụ', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-heading';
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
        return ['heading', 'sub' ];
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
                'default'     => 'Tiêu đề dưới',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="element-heading-and-sub">
            <div class="heading">
                <h2 class="heading__txt f-family-body d-inline-block text-center m-0">
                    <?php echo esc_html( $settings['heading'] ); ?>
                </h2>
            </div>

            <div class="sub-heading">
                <h3 class="sub-heading__txt f-family-body d-inline-block text-center m-0">
                    <?php echo esc_html( $settings['sub_heading'] ); ?>
                </h3>
            </div>
        </div>
    <?php
    }
}