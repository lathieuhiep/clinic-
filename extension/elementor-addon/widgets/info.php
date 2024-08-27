<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Info extends Widget_Base
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
		return 'clinic-info';
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
		return esc_html__('Thông tin', 'clinic');
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
            'working_time',
            [
                'label'       => esc_html__( 'Thời gian làm việc', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '7h30 - 20h mỗi ngày', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'phone',
            [
                'label'       => esc_html__( 'Điện thoại tư vấn', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '0888.888.115 - 024.888.11115',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'support_channel',
            [
                'label'       => esc_html__( 'Kênh hỗ trợ trực tuyến 24/7', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'LIVE CHAT - ZALO', 'clinic' ),
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
	?>
		<div class="element-info">
            <div class="element-info__warp">
                <div class="item working-time">
                    <div class="icon-box">
                        <i class="icon-clock"></i>
                    </div>

                    <div class="body-box">
                        <h3 class="title">
                            <?php esc_html_e('Thời gian làm việc', 'clinic'); ?>
                        </h3>

                        <p class="content">
                            <?php echo esc_html( $settings['working_time'] ); ?>
                        </p>
                    </div>
                </div>

                <div class="item phone">
                    <div class="icon-box">
                        <i class="icon-phone-light"></i>
                    </div>

                    <div class="body-box">
                        <h3 class="title">
                            <?php esc_html_e('Điện thoại tư vấn', 'clinic'); ?>
                        </h3>

                        <p class="content">
                            <?php echo esc_html( $settings['phone'] ); ?>
                        </p>
                    </div>
                </div>

                <div class="item support-channel">
                    <div class="icon-box">
                        <i class="icon-chat-light"></i>
                    </div>

                    <div class="body-box">
                        <h3 class="title">
                            <?php esc_html_e('Kênh hỗ trợ trực tuyến 24/7', 'clinic'); ?>
                        </h3>

                        <p class="content">
                            <?php echo esc_html( $settings['support_channel'] ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}
}