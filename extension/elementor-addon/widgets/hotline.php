<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Hotline extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-hotline';
    }

    public function get_title(): string {
        return esc_html__( 'Hotline', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-headphones';
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
        return ['hotline', 'phone' ];
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
            'image',
            [
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Sử dụng số điện thoại trong theme options', 'clinic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $hotline = clinic_get_opt_hotline();
    ?>
        <div class="element-hotline">
            <div class="element-hotline__icon">
                <i class="icon-phone-light"></i>
            </div>

            <div class="element-hotline__warp">
                <div class="image-box">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                </div>

                <div class="content-box">
                    <p class="txt">
                        <?php esc_html_e( 'Hotline tư vấn miễn phí:', 'clinic' ); ?>
                    </p>

                    <a class="phone" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                        <?php echo esc_html( $hotline ); ?>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
}