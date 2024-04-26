<?php

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Image_Box_Grid extends Widget_Base
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
		return 'clinic-image-box-grid';
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
		return esc_html__('Image Box Grid', 'clinic');
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
		return 'eicon-image-box';
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
		return ['image', 'box' ];
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
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'clinic' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label'       => esc_html__( 'Sub Heading', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'clinic' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'image_sub_heading',
			[
				'label' => esc_html__( 'Choose Image Sub Heading', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'desc',
			[
				'label'     =>  esc_html__( 'Description', 'clinic' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'clinic' ),
			]
		);

		$this->end_controls_section();

        // Tab style
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     =>  esc_html__( 'Heading Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid__layout .item-content__heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'     =>  esc_html__( 'Sub Heading Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid__layout .item-content__sub-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     =>  esc_html__( 'Description Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-image-box-grid__layout .item-content__desc' => 'color: {{VALUE}}',
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
		?>
		<div class="element-image-box-grid text-justify">
			<div class="element-image-box-grid__layout">
				<div class="item item-image">
					<?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
				</div>

				<div class="item item-content">
					<h2 class="item-content__heading text-center">
						<?php echo esc_html($settings['heading']) ?>
					</h2>

					<p class="item-content__sub-heading text-center">
						<?php echo esc_html($settings['sub_heading']) ?>
					</p>

					<?php if ( $settings['image_sub_heading']['id'] ) : ?>
						<p class="item-content__image-sub text-center">
							<?php echo wp_get_attachment_image( $settings['image_sub_heading']['id'], 'large' ); ?>
						</p>
					<?php endif; ?>

					<div class="item-content__desc">
						<?php echo wpautop($settings['desc']); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}