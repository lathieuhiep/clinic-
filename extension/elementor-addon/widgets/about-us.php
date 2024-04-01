<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_About_Us extends Widget_Base
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
		return 'clinic-about-us';
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
		return esc_html__('Về chúng tôi', 'clinic');
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
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
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
			'gallery',
			[
				'label' => esc_html__( 'Thêm ảnh', 'clinic' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'clinic' ),
				'label_block' => true,
				'condition' => [
					'style_layout' => 'style-2',
				]
			]
		);

        $this->add_control(
            'heading_image',
            [
                'label' => esc_html__( 'Chọn ảnh dưới tiêu đề', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'style_layout' => 'style-2',
                ]
            ]
        );

		$this->add_control(
			'desc',
			[
				'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'clinic' ),
			]
		);

		$this->end_controls_section();

        // info
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Thông tin', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style_layout' => 'style-2',
				]
			]
		);

		$this->add_control(
			'company',
			[
				'label'       => esc_html__( 'Tên công ty', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Trung tâm YHCT y hòa đường', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'phone',
			[
				'label'       => esc_html__( 'Điện thoại', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '0345.801.115',
				'label_block' => true,
			]
		);

		$this->add_control(
			'time',
			[
				'label'       => esc_html__( 'Thời gian làm', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '7h30-20h (Tất cả các ngày trong tuần)', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'address',
			[
				'label'       => esc_html__( 'Địa chỉ', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '115 Yên Lãng, Thịnh Quang, Đống Đa, Hà Nộ', 'clinic' ),
				'label_block' => true,
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
		<div class="element-about-us">
			<div class="element-about-us__warp <?php echo esc_attr( $settings['style_layout'] ); ?>">
                <div class="item item-thumbnail">
                    <div class="grid">
	                    <?php foreach ( $settings['gallery'] as $image ) : ?>
                            <div class="grid-item">
			                    <?php echo wp_get_attachment_image( $image['id'], 'large' ); ?>
                            </div>
	                    <?php endforeach; ?>
                    </div>
                </div>

                <div class="item item-content">
                    <?php if ( $settings['style_layout'] == 'style-2' && $settings['heading_image'] ) : ?>
                        <h3 class="heading">
		                    <?php echo nl2br( $settings['heading'] ); ?>
                        </h3>

                        <div class="heading-image-line">
                            <?php echo wp_get_attachment_image( $settings['heading_image']['id'], 'full' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="desc text-justify">
	                    <?php echo wpautop( $settings['desc'] ); ?>
                    </div>

                    <?php if ( $settings['style_layout'] == 'style-2' ) : ?>
                        <div class="info">
                            <h3 class="company">
                                <?php echo esc_html( $settings['company'] ); ?>
                            </h3>

                            <div class="star">
                                <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/vote-star.png' ) ) ?>" alt="">
                            </div>

                            <div class="group">
                                <p class="txt">
                                    <span><?php esc_html_e( 'Hotline', 'clinic' ); ?>:</span>

                                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $settings['phone'] ) ); ?>">
                                        <?php echo esc_html( $settings['phone'] ); ?>
                                    </a>
                                </p>

                                <p class="txt">
                                    <span><?php esc_html_e( 'Thời gian thăm khám', 'clinic' ); ?>:</span>

                                    <span><?php echo esc_html( $settings['time'] ); ?></span>
                                </p>

                                <p class="txt">
                                    <span><?php esc_html_e( 'Địa chỉ', 'clinic' ); ?>:</span>

                                    <span><?php echo esc_html( $settings['address'] ); ?></span>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
			</div>
		</div>
		<?php
	}
}