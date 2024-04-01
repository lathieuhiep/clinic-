<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Grid_Text_Editor extends Widget_Base
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
		return 'clinic-grid-text-editor';
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
		return esc_html__('Grid text editor', 'clinic');
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
		// list
		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'Danh sách', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
					[
						'list_title' => __( 'Tiêu đề #3', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Style', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .element-grid-text-editor__warp .item',
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
		<div class="element-grid-text-editor">
			<div class="element-grid-text-editor__warp">
				<?php foreach ( $list as $item ) : ?>
					<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<h3 class="title">
							<?php echo esc_html( $item['list_title'] ); ?>
						</h3>

						<div class="content">
							<?php echo wpautop( $item['list_content'] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
	}
}