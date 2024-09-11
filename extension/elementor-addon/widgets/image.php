<?php

use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Image extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-image';
    }

    public function get_title(): string {
        return esc_html__( 'Ảnh', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-image-hotspot';
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
        return ['image' ];
    }

    protected function register_controls(): void {

        // image section
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image', [
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'condition' => [
                    'image[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // image style
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Chiều rộng ảnh', 'clinic' ),
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
                    '{{WRAPPER}} .element-image__warp img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Chiều cao ảnh', 'clinic' ),
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
                    '{{WRAPPER}} .element-image__warp img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-fit',
            [
                'label' => esc_html__( 'Object Fit', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'image_height[size]!' => '',
                ],
                'options' => [
                    '' => esc_html__( 'Default', 'elementor' ),
                    'fill' => esc_html__( 'Fill', 'elementor' ),
                    'cover' => esc_html__( 'Cover', 'elementor' ),
                    'contain' => esc_html__( 'Contain', 'elementor' ),
                    'scale-down' => esc_html__( 'Scale Down', 'elementor' ),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-image__warp img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-position',
            [
                'label' => esc_html__( 'Object Position', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__( 'Center Center', 'elementor' ),
                    'center left' => esc_html__( 'Center Left', 'elementor' ),
                    'center right' => esc_html__( 'Center Right', 'elementor' ),
                    'top center' => esc_html__( 'Top Center', 'elementor' ),
                    'top left' => esc_html__( 'Top Left', 'elementor' ),
                    'top right' => esc_html__( 'Top Right', 'elementor' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'elementor' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'elementor' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'elementor' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} .element-image__warp img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'image_height[size]!' => '',
                    'object-fit' => [ 'cover', 'contain', 'scale-down' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .element-image__warp img',
            ]
        );

        $this->add_control(
            'image_border_radius',
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
                    '{{WRAPPER}} .element-image__warp img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'position_absolute',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Vị trí tuyệt đối', 'clinic'),
                'label_off'     =>  esc_html__('Không', 'clinic'),
                'label_on'      =>  esc_html__('Có', 'clinic'),
                'return_value'  =>  'yes',
                'default'       =>  '',
            ]
        );

        $this->add_responsive_control(
            'position_left',
            [
                'label' => esc_html__( 'Bên trái', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-image__warp' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'position_absolute' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'position_top',
            [
                'label' => esc_html__( 'Bên trên', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-image__warp' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'position_absolute' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['image']['url'] ) ) {
            return;
        }
    ?>
        <div class="element-image position-relative">
            <figure class="element-image__warp<?php echo esc_attr( $settings['position_absolute'] ? ' position-absolute' : '' ); ?>">
                <?php Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
            </figure>
        </div>
    <?php
    }
}