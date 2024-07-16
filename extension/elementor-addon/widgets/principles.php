<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Principles extends Widget_Base
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
		return 'clinic-principles';
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
		return esc_html__('Nguyên tắc khám chữa', 'clinic');
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
		return ['image', 'text', 'list'];
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
		// content
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
				'label' => esc_html__( 'Chọn ảnh', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tiêu đề' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Nội dung' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_background_color', [
				'label' => esc_html__( 'Background Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-principles__warp {{CURRENT_ITEM}}.item__repeater' => 'background-color: {{VALUE}}'
				],
			]
		);

		$repeater->add_control(
			'list_number_color', [
				'label' => esc_html__( 'Number Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-principles__warp {{CURRENT_ITEM}}.item__repeater:after' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Tiêu đề #1', 'clinic' ),
					],
					[
						'list_title' => __( 'Tiêu đề #2', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style number
		$this->start_controls_section(
			'style_number_section',
			[
				'label' => esc_html__( 'Number', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-principles__warp .item__repeater:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .element-principles__warp .item__repeater:after',
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
		$list = $settings['list'];
		?>
		<div class="element-principles">
			<div class="element-principles__warp">
				<div class="item">
					<div class="item__thumbnail">
						<?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
					</div>
				</div>

				<div class="item item-grid">
					<?php foreach ( $list as $key => $item ) : ?>
						<div class="item__repeater elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" data-number="<?php echo esc_html( addZeroBeforeNumber($key + 1) ); ?>">

							<?php echo wpautop( $item['list_content'] ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}