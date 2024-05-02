<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Contact_Form_7 extends Widget_Base {
	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'clinic-contact-form-7';
	}

	public function get_title(): string {
		return esc_html__( 'Contact Form 7', 'clinic' );
	}

	public function get_icon(): string {
		return 'eicon-form-horizontal';
	}

	protected function register_controls(): void {

		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Contact Form', 'clinic' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
				'default'     => esc_html__( 'ĐĂNG KÝ THĂM KHÁM', 'clinic' ),
				'label_block' => true
			]
		);

        $this->add_control(
            'content',
            [
                'label'     =>  esc_html__( 'Nội dung', 'clinic' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  '',
            ]
        );

		$this->add_control(
			'contact_form_list',
			[
				'label'       => esc_html__( 'Chọn form liên hệ', 'clinic' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => clinic_get_form_cf7(),
				'default'     => '0',
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
                    '{{WRAPPER}} .element-contact-form-7 .heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .element-contact-form-7.style-1 .heading:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-contact-form-7 .heading',
            ]
        );

        $this->end_controls_section();

        // content style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'text-start'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'text-center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'text-end' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'text-justify' => [
                        'title' =>  esc_html__( 'Justify', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'text-justify',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     =>  esc_html__( 'Color', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-contact-form-7 .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-contact-form-7 .content',
            ]
        );

        $this->end_controls_section();

        // error style
        $this->start_controls_section(
            'error_style_section',
            [
                'label' => esc_html__( 'Thông báo lỗi', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'error_color',
            [
                'label'     =>  esc_html__( 'Color', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .wpcf7-not-valid-tip, {{WRAPPER}} .wpcf7-response-output' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'error_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .wpcf7-not-valid-tip, {{WRAPPER}} .wpcf7-response-output',
            ]
        );

        $this->end_controls_section();
	}

	protected function render(): void
    {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['contact_form_list'] ) ) :
			?>

            <div class="element-contact-form-7 <?php echo esc_attr($settings['style_layout']); ?>">
                <?php if ( $settings['heading'] ) : ?>
                    <h3 class="heading text-center">
		                <?php echo esc_html( $settings['heading'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( $settings['content'] ) : ?>
                    <div class="content <?php echo esc_attr($settings['content_align']); ?>">
                        <?php echo wpautop( $settings['content'] ); ?>
                    </div>
                <?php endif; ?>

				<?php echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' ); ?>
            </div>

		<?php
		endif;
	}

}