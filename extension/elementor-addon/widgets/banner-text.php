<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Banner_Text extends Widget_Base
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
		return 'clinic-banner-text';
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
		return esc_html__('Banner text', 'clinic');
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
		return ['banner', 'text'];
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
			'instruct_content_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'instruct_heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'HƯỚNG DẪN ĐĂNG KÝ KHÁM BỆNH', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'instruct_content',
			[
				'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Trong trường hợp người bệnh không có nhu cầu trị liệu, lấy thuốc thì có thể ra về sau quá trình thăm khám, tư vấn mà không phải trả bất cứ một khoản chi phí nào vì chúng tôi Khám và tư vấn bệnh hoàn toàn miễn phí.', 'clinic' ),
			]
		);

		$this->end_controls_section();

		// info
		$this->start_controls_section(
			'info_content_section',
			[
				'label' => esc_html__( 'Thông tin', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'info_heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'LỊCH LÀM VIỆC, KHÁM CHỮA BỆNH CỦA PHÒNG KHÁM', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_content',
			[
				'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Trung tâm YHCT Y Hòa Đường làm việc tất cả các ngày trong tuần, kể cả Thứ 7 và Chủ nhật', 'clinic' ),
			]
		);

		$this->end_controls_section();

		// style heading
		$this->start_controls_section(
			'style_heading_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Màu', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-about-us__warp .item .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .element-about-us__warp .item .heading',
			]
		);

		$this->end_controls_section();

		// style desc
		$this->start_controls_section(
			'style_desc_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Màu', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-about-us__warp .item .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .element-about-us__warp .item .desc',
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
		<div class="element-banner-text">
			<div class="instruct">
				<h2 class="instruct__heading">
					<?php echo esc_html( $settings['instruct_heading'] ); ?>
				</h2>

				<div class="instruct__content">
					<?php echo wpautop( $settings['instruct_content'] ); ?>
				</div>
			</div>

			<div class="info">
                <div class="info__warp">
                    <h3 class="heading">
		                <?php echo esc_html( $settings['info_heading'] ); ?>
                    </h3>

                    <div class="content">
		                <?php echo wpautop( $settings['info_content'] ); ?>
                    </div>
                </div>
			</div>
		</div>
		<?php
	}
}