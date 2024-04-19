<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Quality extends Widget_Base
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
		return 'clinic-quality';
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
		return esc_html__('Chất lượng', 'clinic');
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
		return ['image', 'text', 'quality'];
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
				'label' => esc_html__( 'Ảnh', 'clinic' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'List', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title #1' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 8,
				'default' => esc_html__( 'List Content' , 'clinic' ),
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
						'list_title' => __( 'Title #1', 'clinic' ),
					],
					[
						'list_title' => __( 'Title #2', 'clinic' ),
					],
					[
						'list_title' => __( 'Title #3', 'clinic' ),
					],
					[
						'list_title' => __( 'Title #4', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style title
		$this->start_controls_section(
			'style_title_section',
			[
				'label' => esc_html__( 'Title', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_title_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-quality__warp .list-group .list-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_title_typography',
				'selector' => '{{WRAPPER}} .element-quality__warp .list-group .list-title',
			]
		);

		$this->end_controls_section();

		// style list
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Content', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_content_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-quality__warp .list-group .list-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_content_typography',
				'selector' => '{{WRAPPER}} .element-quality__warp .list-group .list-content',
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

		$medical_appointment_form = clinic_get_opt_medical_appointment();
		?>
		<div class="element-quality">
			<div class="element-quality__warp">
				<div class="item item__thumbnail">
					<?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
				</div>

				<div class="item item__list">
					<div class="list-group">
						<?php
						$number_list = 1;
						foreach ( $settings['list'] as $item ) :
							?>
							<div class="repeater-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
								<h4 class="list-title f-family-body">
									<span class="number"><?php echo esc_html($number_list); ?></span>&#46;
									<span class="text"><?php echo esc_html( $item['list_title'] ); ?></span>
								</h4>

								<p class="list-content">
									<?php echo esc_html( $item['list_content'] ); ?>
								</p>
							</div>
							<?php $number_list++; endforeach; ?>
					</div>

					<?php if ( $medical_appointment_form ) : ?>
						<div class="action-box text-center">
							<a class="booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
								<?php esc_html_e('Đặt lịch ngay', 'clinic'); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}