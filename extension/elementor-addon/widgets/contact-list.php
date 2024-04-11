<?php

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Contact_List extends Widget_Base
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
		return 'clinic-contact-us';
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
		return esc_html__('Contact List', 'clinic');
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
		return 'eicon-mail';
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
		return ['contact' ];
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
            'more_options',
            [
                'label' => esc_html__( 'Thiết lập liên hệ trong theme options', 'clinic' ),
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

        // theme options
        $call_phone = clinic_get_opt_hotline();
        $chat_zalo = clinic_get_opt_chat_zalo();
        $chat_doctor = clinic_get_opt_link_chat_doctor();
    ?>
		<div class="element-contact-list">
            <?php if ( $call_phone ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <img class="zoom-in-out" src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/icons/icon-dt.png' ) ) ?>" alt="">
                    </div>

                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $call_phone ) ); ?>">
                        <?php echo esc_html( $call_phone ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( $chat_zalo ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <img class="zoom-in-out" src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/icons/icon-zalo.png' ) ) ?>" alt="">
                    </div>

                    <a class="chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($chat_zalo['phone']) ); ?>" data-phone="<?php echo esc_attr($chat_zalo['phone']); ?>" data-qr-code="<?php echo esc_attr($chat_zalo['qr_code']); ?>">
                        <?php esc_html_e('ZALO', 'clinic'); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( $chat_doctor ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <img class="zoom-in-out" src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/icons/icon-chat.png' ) ) ?>" alt="">
                    </div>

                    <a href="<?php echo esc_url( $chat_doctor ); ?>" target="_blank">
                        <?php esc_html_e('CHAT', 'clinic'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php
	}
}