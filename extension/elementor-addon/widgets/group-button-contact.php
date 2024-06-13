<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
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

        // style heading
        $this->start_controls_section(
            'btn_style_section',
            [
                'label' => esc_html__( 'Nút', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'clinic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-group-button-contact .btn-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-group-button-contact .btn-contact' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .element-group-button-contact .btn-contact',
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

        $hotline = clinic_get_opt_hotline();
		$link_chat = clinic_get_opt_link_chat_doctor();
	?>
		<div class="element-group-button-contact">
			<?php if ( $hotline ) : ?>
                <a class="btn-contact btn-call text-uppercase" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ) ?>">
                    <i class="icon-phone-light d-inline-block alo-circle-anim"></i>
                    <span><?php echo esc_html( $hotline ) ?></span>
                </a>
			<?php endif; ?>

			<?php if ( $link_chat ) : ?>
				<a class="btn-contact btn-chat text-uppercase" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                    <i class="icon-chat-light"></i>
                    <span><?php esc_html_e( 'Bác sĩ tư vấn', 'clinic' ); ?></span>
				</a>
			<?php endif; ?>
		</div>
	<?php
	}
}