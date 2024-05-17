<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Statistical extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-statistical';
    }

    public function get_title(): string {
        return esc_html__( 'Con số thông kê', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-number-field';
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
        return ['number', 'statistical' ];
    }

    protected function register_controls(): void {

        // layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__( 'Cột', 'clinic' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .element-statistical__list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->end_controls_section();

        // list section
        $this->start_controls_section(
            'list_section',
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
                'default' => esc_html__( 'List Title' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_parameter', [
                'label' => esc_html__( 'Thông số', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => '+15',
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

        // contact title style
        $this->start_controls_section(
            'contact_title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề liên hệ', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_title_color',
            [
                'label'     =>  esc_html__( 'Color', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-statistical__action .contact-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'contact_title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-statistical__action .contact-title',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        if ( empty($settings['list']) ) :
            return;
        endif;

        if ( ! empty( $settings['website_link']['url'] ) ) {
            $this->add_link_attributes( 'contact_btn_link', $settings['contact_btn_link'] );
        }

        $medical_appointment_form = clinic_get_opt_medical_appointment();
    ?>
        <div class="element-statistical">
            <div class="element-statistical__list">
                <?php foreach ($settings['list'] as $item) : ?>
                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <p class="parameter">
                            <?php echo esc_html( $item['list_parameter'] ); ?>
                        </p>

                        <p class="title">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="element-statistical__action">
                <p class="contact-title">
                    <?php esc_html_e('Nhanh tay!', 'clinic'); ?>
                </p>

                <?php if ( $medical_appointment_form ) : ?>
                    <a class="btn-booking text-uppercase text-center d-flex align-items-center justify-content-center" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                        <?php esc_html_e('Đặt lịch khám', 'clinic'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }
}