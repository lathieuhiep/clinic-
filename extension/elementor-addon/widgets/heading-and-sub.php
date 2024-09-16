<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Heading_And_Sub extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-heading-and-sub';
    }

    public function get_title(): string {
        return esc_html__( 'Tiêu đề chính và phụ', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-heading';
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
        return ['heading', 'sub' ];
    }

    protected function register_controls(): void {

        // Content testimonial
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
            'sub_heading',
            [
                'label'       => esc_html__( 'Tiêu đề dưới', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Tiêu đề dưới',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // style title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Tiêu đề', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label'     =>  esc_html__( 'Căn chỉnh', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Căn trái', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Căn giữa', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Căn phải', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify'=> [
                        'title' =>  esc_html__( 'Căn đêu hai lề', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-heading-and-sub .heading' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Màu', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-heading-and-sub .heading' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-heading-and-sub .heading',
            ]
        );

        $this->end_controls_section();

        // style sub heading
        $this->start_controls_section(
            'sub_style_section',
            [
                'label' => esc_html__('Tiêu đề phụ', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_alignment',
            [
                'label'     =>  esc_html__( 'Căn chỉnh', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Căn trái', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Căn giữa', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Căn phải', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify'=> [
                        'title' =>  esc_html__( 'Căn đêu hai lề', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-heading-and-sub .sub-heading' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__('Màu', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-heading-and-sub .sub-heading' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-heading-and-sub .sub-heading',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="element-heading-and-sub">
            <div class="heading">
                <?php echo esc_html( $settings['heading'] ); ?>
            </div>

            <div class="sub-heading">
                <?php echo esc_html( $settings['sub_heading'] ); ?>
            </div>
        </div>
    <?php
    }
}