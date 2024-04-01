<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
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
		return esc_html__('Lợi ích đặt hẹn', 'clinic');
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
		// content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'clinic' ),
				'label_block' => true,
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

        // list style section
        $this->start_controls_section(
            'list_style_section',
            [
                'label' => esc_html__( 'Danh sách', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_padding',
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
                    '{{WRAPPER}} .element-compare-appointments__warp .list-box .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .element-compare-appointments__warp .list-box .item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'selector' => '{{WRAPPER}} .element-compare-appointments__warp .list-box .item',
            ]
        );

        $this->add_control(
            'list_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'clinic' ),
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
                    '{{WRAPPER}} .element-compare-appointments__warp .list-box .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // number style section
        $this->start_controls_section(
            'number_style_section',
            [
                'label' => esc_html__( 'Number', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     =>  esc_html__( 'Màu sắc', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-compare-appointments__warp .list-box .item .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-compare-appointments__warp .list-box .item .number',
            ]
        );

        $this->add_control(
            'number_background_color',
            [
                'label'     =>  esc_html__( 'Màu nền', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-compare-appointments__warp .list-box .item .number' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // title style section
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Màu sắc', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-compare-appointments__warp .list-box .item .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-compare-appointments__warp .list-box .item .title',
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
                <h3 class="heading text-uppercase">
                    <span class="icon icon-check"></span>
                    <span class="txt"><?php esc_html_e('Hẹn lịch khám online', 'clinic'); ?></span>
                </h3>

                <div class="list-box">
                    <?php foreach ( $settings['list'] as $key => $item ) : ?>
                        <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <p class="number">
                                <?php echo esc_html( addZeroBeforeNumber( $key + 1 ) ); ?>
                            </p>

                            <h3 class="title">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </h3>
                        </div>
                    <?php endforeach; ?>
                </div>
			</div>
		</div>
	<?php
	}
}