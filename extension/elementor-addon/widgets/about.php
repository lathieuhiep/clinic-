<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_About extends Widget_Base
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
		return 'clinic-about';
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
		return esc_html__('About', 'clinic');
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
		return 'eicon-text';
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
		return ['image', 'text'];
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
			'image_section',
			[
				'label' => esc_html__( 'Image', 'clinic' ),
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
			'desc',
			[
				'label'     =>  esc_html__( 'Description', 'clinic' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'clinic' ),
			]
		);

		$this->end_controls_section();

		// style heading
		$this->start_controls_section(
			'style_heading_section',
			[
				'label' => esc_html__( 'Heading', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-about__warp .item .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .element-about__warp .item .heading',
			]
		);

		$this->end_controls_section();

		// style desc
		$this->start_controls_section(
			'style_desc_section',
			[
				'label' => esc_html__( 'Description', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-about__warp .item .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .element-about__warp .item .desc',
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
		?>
		<div class="element-about">
			<div class="element-about__warp">
                <div class="item item-left">
                    <h3 class="heading d-md-none text-center">
		                <?php echo esc_html( $settings['heading'] ); ?>
                    </h3>

	                <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                </div>

                <div class="item item-right">
                    <h3 class="heading d-none d-md-block">
                        <?php echo esc_html( $settings['heading'] ); ?>
                    </h3>

                    <div class="desc">
	                    <?php echo wpautop( $settings['desc'] ); ?>
                    </div>

                    <div class="action">
	                    <?php if ( $hotline ) : ?>
                            <a class="hotline" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ); ?>">
			                    <i class="icon-phone-circle"></i>
                                <span><?php esc_html_e('TÔI CẦN TƯ VẤN', 'clinic'); ?></span>
                            </a>
	                    <?php endif; ?>
                    </div>
                </div>
			</div>
		</div>
		<?php
	}
}