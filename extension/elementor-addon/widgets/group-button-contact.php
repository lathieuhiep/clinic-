<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Group_Button_Contact extends Widget_Base
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
		return 'clinic-group-button-contact';
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
		return esc_html__('Nhóm nút liên hệ', 'clinic');
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
		return ['group', 'button' ];
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
				'label' => esc_html__( 'Sử dụng liên hệ trong theme options (mục giờ làm - liên hệ)', 'clinic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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

		$phone = clinic_get_opt_hotline();
		$medical_appointment_form = clinic_get_opt_medical_appointment();
		$link_chat = clinic_get_opt_link_chat_doctor();
	?>
		<div class="element-group-button-contact">
            <?php if ( $link_chat ) : ?>
                <a class="btn-contact" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                    <img src="<?php echo esc_url(get_theme_file_uri('/extension/elementor-addon/images/home_button_bacsituvan.png')) ?>" alt="">
                </a>
            <?php endif; ?>

			<?php if ( $medical_appointment_form ) : ?>
				<button class="btn btn-contact border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                    <img src="<?php echo esc_url(get_theme_file_uri('/extension/elementor-addon/images/home_button_datlichkham.png')) ?>" alt="">
				</button>
			<?php endif; ?>
		</div>
	<?php
	}
}