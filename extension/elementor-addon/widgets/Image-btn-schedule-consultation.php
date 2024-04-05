<?php

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Image_Btn_Schedule_Consultation extends Widget_Base
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
		return 'clinic-image-btn-schedule-consultation';
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
		return esc_html__('Đặt hẹn và tư vấn', 'clinic');
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
		return ['image', 'list', 'link'];
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
			'image_button_schedule',
			[
				'label' => esc_html__( 'Ảnh link đặt lịch', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image_button_consultation',
			[
				'label' => esc_html__( 'Ảnh link bác sĩ tư vấn', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
		$link_chat = clinic_get_opt_link_chat_doctor();
        $chat_zalo = clinic_get_opt_chat_zalo();
    ?>
		<div class="element-schedule-consultation">
            <div class="element-schedule-consultation__warp">
	            <?php if ( $settings['image_button_schedule']['id'] && $medical_appointment_form ) : ?>
                    <a class="item" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
			            <?php echo wp_get_attachment_image( $settings['image_button_schedule']['id'], 'large' ); ?>
                    </a>
	            <?php
                endif;

                if ( $chat_zalo ) :
                    $zalo_phone = $chat_zalo['phone'];
                    $zalo_qr_code = $chat_zalo['qr_code'];
                ?>
                    <a class="item chat-with-us__zalo" href="#" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
                        <?php echo wp_get_attachment_image( $settings['image_button_consultation']['id'], 'large' ); ?>
                    </a>
                <?php endif; ?>
            </div>
		</div>
		<?php
	}
}