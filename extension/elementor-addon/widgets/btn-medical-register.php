<?php

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Btn_Medical_Register extends Widget_Base
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
		return 'clinic-btn-medical-register';
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
		return esc_html__('Button đăng kí khám', 'clinic');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-button';
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
		return ['button'];
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
			'content_section',
			[
				'label' => esc_html__( 'Content', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image_mobile',
			[
				'label' => esc_html__( 'Image Mobile', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'text', [
				'label' => esc_html__( 'Nôi dụng', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Đăng ký ngay' , 'clinic' ),
				'label_block' => true,
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

		$medical_appointment_form = clinic_get_opt_medical_appointment();
    ?>
		<div class="element-btn-medical-register">
            <div class="element-btn-medical-register__warp">
	            <?php
                if ( !empty( $settings['image'] ) && !empty( $settings['image']['id'] ) ) :
	                echo wp_get_attachment_image( $settings['image']['id'], 'full', '', array(
                            'class' => 'image-desktop'
                    ) );
                endif;

	            if ( !empty( $settings['image_mobile'] ) && !empty( $settings['image_mobile']['id'] ) ) :
		            echo wp_get_attachment_image( $settings['image_mobile']['id'], 'full', '', array(
			            'class' => 'image-mobile'
		            ) );
	            endif;
                ?>

	            <?php if ( $medical_appointment_form ) : ?>
                    <a class="btn-action" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
			            <?php echo esc_html( $settings['text'] ); ?>
                    </a>
	            <?php endif; ?>
            </div>
		</div>
		<?php
	}
}