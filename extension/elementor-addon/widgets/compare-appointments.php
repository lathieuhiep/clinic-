<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Compare_Appointments extends Widget_Base
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
		return 'clinic-compare-appointments';
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
		return esc_html__('So sánh đặt hẹn', 'clinic');
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
		return 'eicon-gallery-grid';
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
		return ['image', 'grid', 'gallery', 'box' ];
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
		// appointment section
		$this->start_controls_section(
			'content_appointment_section',
			[
				'label' => esc_html__( 'Hẹn trước', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater_appointment = new Repeater();

		$repeater_appointment->add_control(
			'list_appointment_title', [
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list_appointment',
			[
				'label' => esc_html__( 'Danh sách', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_appointment->get_controls(),
				'default' => [
					[
						'list_appointment_title' => esc_html__( 'Title #1', 'clinic' ),
					],
					[
						'list_appointment_title' => esc_html__( 'Title #2', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_appointment_title }}}',
			]
		);

		$this->end_controls_section();

		// no appointment section
		$this->start_controls_section(
			'content_no_appointment_section',
			[
				'label' => esc_html__( 'Không hẹn trước', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater_no_appointment = new Repeater();

		$repeater_no_appointment->add_control(
			'list_no_appointment_title', [
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list_no_appointment',
			[
				'label' => esc_html__( 'Danh sách', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_no_appointment->get_controls(),
				'default' => [
					[
						'list_no_appointment_title' => esc_html__( 'Title #1', 'clinic' ),
					],
					[
						'list_no_appointment_title' => esc_html__( 'Title #2', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_no_appointment_title }}}',
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
		<div class="element-compare-appointments">
			<div class="element-compare-appointments__warp">
				<div class="list-box list-appointment">
					<div class="list-box__txt">
						<span class="text-uppercase"><?php esc_html_e('Hẹn trước', 'clinic'); ?></span>
					</div>

					<div class="list-box__group">
						<?php foreach ( $settings['list_appointment'] as $key => $item ) : ?>
							<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
								<div class="item__left">
									<p class="number">
										<?php echo esc_html( addZeroBeforeNumber( $key + 1 ) ); ?>
									</p>
								</div>

								<div class="item__right">
									<h3 class="title">
										<?php echo esc_html( $item['list_appointment_title'] ); ?>
									</h3>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="list-box middle">
					<span class="txt text-uppercase"><?php esc_html_e('Với'); ?></span>
				</div>

				<div class="list-box list-no-appointment">
					<div class="list-box__txt">
						<span class="text-uppercase"><?php esc_html_e('không hẹn trước', 'clinic'); ?></span>
					</div>

					<div class="list-box__group">
						<?php foreach ( $settings['list_no_appointment'] as $key => $item ) : ?>
							<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
								<div class="item__left">
									<p class="number">
										<?php echo esc_html( addZeroBeforeNumber( $key + 1 ) ); ?>
									</p>
								</div>

								<div class="item__right">
									<h3 class="title">
										<?php echo esc_html( $item['list_no_appointment_title'] ); ?>
									</h3>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}