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
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'clinic' ),
				'label_block' => true
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
	}

	protected function render(): void
    {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['contact_form_list'] ) ) :
			?>

            <div class="element-contact-form-7">
                <?php if ( $settings['heading'] ) : ?>
                    <h3 class="heading text-center">
		                <?php echo esc_html( $settings['heading'] ); ?>
                    </h3>
                <?php endif; ?>


				<?php echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' ); ?>
            </div>

		<?php
		endif;
	}

}