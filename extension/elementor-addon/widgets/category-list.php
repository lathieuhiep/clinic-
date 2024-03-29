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

class Clinic_Elementor_Category_List extends Widget_Base
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
		return 'clinic-category-list';
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
		return esc_html__('Category List', 'clinic');
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
		return 'eicon-post-list';
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
		return ['list', 'category' ];
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
			'style_layout',
			[
				'label' => esc_html__('Kiểu', 'clinic'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__('Kiểu 1', 'clinic'),
					'style-2' => esc_html__('Kiểu 2', 'clinic'),
				],
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'image_feature',
			[
				'label' => esc_html__( 'Chọn ảnh chính', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label' => esc_html__( 'Chiều cao tối thiểu', 'smartcity' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .element-category-list__warp .image-box' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_content_section',
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
				'default' => esc_html__( 'Tiều đề' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_category',
			[
				'label' => esc_html__( 'Danh mục', 'clinic' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => clinic_check_get_cat('category'),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Danh sách', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

        // cate list style
		$this->start_controls_section(
			'list_style',
			[
				'label' => esc_html__('Danh sách', 'clinic'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'list_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .element-category-list__warp .cate-nav__box',
			]
		);

		$this->end_controls_section();

		// title style content
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Title', 'clinic'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'clinic'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-specialist__grid .item .item__title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Color Hover', 'clinic'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-specialist__grid .item:hover .item__title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'clinic' ),
				'selector' => '{{WRAPPER}} .element-specialist__grid .item .item__title',
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

		<div class="element-category-list <?php echo esc_attr(  $settings['style_layout'] ); ?>">
            <div class="element-category-list__warp">
                <div class="cate-nav">
                    <h3 class="cate-group f-family-body">
                        <?php echo esc_html( $settings['heading'] ); ?>
                    </h3>

                    <div class="cate-nav__box">
	                    <?php if ( $settings['list'] ) : ?>
                            <ul class="list">
			                    <?php
			                    foreach ( $settings['list'] as $item) :
				                    $category_link = get_category_link( $item['list_category'] );
                                ?>
                                    <li class="item-cate">
                                        <a class="link" href="<?php echo esc_url( $category_link ); ?>">
						                    <?php echo esc_html( $item['list_title'] ) ?>
                                        </a>
                                    </li>
			                    <?php endforeach; ?>
                            </ul>
	                    <?php endif; ?>
                    </div>
                </div>

                <div class="image-box">
	                <?php echo wp_get_attachment_image( $settings['image_feature']['id'], 'large' ); ?>
                </div>
            </div>
		</div>

    <?php
	}
}