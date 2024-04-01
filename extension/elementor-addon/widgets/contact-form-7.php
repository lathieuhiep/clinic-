<?php

use Elementor\Utils;
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
					'style-1' => esc_html__('Kiểu 1 (Có ảnh)', 'clinic'),
					'style-2' => esc_html__('Kiểu 2', 'clinic'),
					'style-3' => esc_html__('Kiểu 3', 'clinic'),
				],
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
                'condition' => [
                    'style_layout' => 'style-1',
                ]
            ]
        );

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Tiêu đề', 'clinic' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'sub_heading',
            [
                'label'       => esc_html__( 'Tiêu đề phụ', 'clinic' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Tiêu đề phụ', 'clinic' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'contact_form_list',
			[
				'label'       => esc_html__( 'Select Form', 'clinic' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => clinic_get_form_cf7(),
				'default'     => '0',
			]
		);

		$this->add_control(
			'note',
			[
				'label'       => esc_html__( 'Lưu ý', 'clinic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Lưu ý', 'clinic' ),
				'label_block' => true,
				'condition' => [
					'style_layout' => 'style-3',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
    ?>
        <div class="element-contact-form-7 <?php echo esc_attr( $settings['style_layout'] ); ?>">
            <?php if ( $settings['style_layout'] == 'style-1' && $settings['image'] ) : ?>
                <div class="item item-thumbnail">
                    <div class="thumbnail-box">
                        <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="item item-form">
                <?php if ( $settings['heading'] ) : ?>
                    <h3 class="heading text-center">
                        <?php echo nl2br( $settings['heading'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( $settings['sub_heading'] ) : ?>
                    <p class="sub-heading">
                        <?php echo nl2br( $settings['sub_heading'] ); ?>
                    </p>
                <?php endif; ?>

                <?php
                if ( ! empty( $settings['contact_form_list'] ) ) :
	                echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' );
                endif;
                ?>

	            <?php if ( $settings['style_layout'] == 'style-3' && $settings['note'] ) : ?>
                    <p class="note">
			            <?php echo nl2br( $settings['note'] ); ?>
                    </p>
	            <?php endif; ?>
            </div>
        </div>
    <?php
	}
}