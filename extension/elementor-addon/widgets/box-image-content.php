<?php

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Box_Image_Content extends Widget_Base
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
        return 'box-image-content';
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
        return esc_html__('Về chúng tôi 2', 'clinic');
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
        // image section
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

        $this->end_controls_section();

        // heading section
        $this->start_controls_section(
            'heading_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_1',
            [
                'label'       => esc_html__( 'Tiêu đề 1', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tiêu đề 1', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_2',
            [
                'label'       => esc_html__( 'Tiêu đề 2', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tiêu đề 2', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // sub heading section
        $this->start_controls_section(
            'sub_heading_section',
            [
                'label' => esc_html__( 'Tiêu đề phụ', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tiêu đề phụ', 'clinic' ),
                'label_block' => true,
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
        $medical_appointment_form = clinic_get_opt_medical_appointment();
    ?>
        <div class="element-box-image-content">
            <div class="element-box-image-content__warp">
                <div class="image-box">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                </div>

                <div class="body-box">
                    <div class="top">
                        <?php if ( $settings['heading_1'] ) : ?>
                            <h3 class="heading heading-1">
                                <?php echo esc_html( $settings['heading_1'] ); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( $settings['heading_2'] ) : ?>
                            <h3 class="heading heading-2">
                                <?php echo esc_html( $settings['heading_2'] ); ?>
                            </h3>
                        <?php endif; ?>
                    </div>

                    <div class="dividing-line"></div>

                    <?php if ( $settings['sub_heading'] ) : ?>
                        <h4 class="sub-heading">
                            <?php echo esc_html( $settings['sub_heading'] ); ?>
                        </h4>
                    <?php endif; ?>

                    <div class="desc text-justify">
                        <?php echo wpautop( $settings['desc'] ); ?>
                    </div>

                    <?php if ( $medical_appointment_form ) : ?>
                        <div class="action-box">
                            <a class="action-box__booking text-uppercase" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                <?php esc_html_e('Đặt lịch ngay', "clinic"); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }
}