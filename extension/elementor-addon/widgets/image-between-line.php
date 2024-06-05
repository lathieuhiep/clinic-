<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

class Clinic_Elementor_Image_Between_Line extends Widget_Base
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
		return 'clinic-heading-between-line';
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
		return esc_html__('Image Between Line', 'clinic');
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
		return 'eicon-image-before-after';
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
		return ['mage', 'line', 'between' ];
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
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Chiều rộng vùng chứa', 'clinic' ),
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
                    '{{WRAPPER}} .element-image-between-line__warp' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'flex-start'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'flex-end' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .element-image-between-line' => 'align-items: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

        // style line
		$this->start_controls_section(
			'style_line_section',
			[
				'label' => esc_html__( 'Line', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'line_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-heading-between-line__grid .line' => 'background-color: {{VALUE}}',
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
		<div class="element-image-between-line">
			<div class="element-image-between-line__warp">
                <span class="line"></span>

				<div class="box-image">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
				</div>

                <span class="line"></span>
			</div>
		</div>
		<?php
	}
}