<?php

use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_System_Grid extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-system-grid';
    }

    public function get_title(): string {
        return esc_html__( 'Hệ thống', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-gallery-grid';
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
        return ['system', 'grid' ];
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
                    '{{WRAPPER}} .element-system-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_column_gap',
            [
                'label' => esc_html__( 'Grid column gap', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-system-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_row_gap',
            [
                'label' => esc_html__( 'Grid row gap', 'clinic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-system-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // image icon section
        $this->start_controls_section(
            'image_icon_section',
            [
                'label' => esc_html__( 'Ảnh icon', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_icon', [
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
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
            'list_image', [
                'label' => esc_html__( 'Image', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'clinic' ),
                'show_label' => false,
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

        // title style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
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
                'toggle' => true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-system-grid .item__body .title' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Màu', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-system-grid .item__body .title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-system-grid .item__body .title',
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
                'default' => 'justify',
                'toggle' => true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-system-grid .item__body .content' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Màu', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-system-grid .item__body .content' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-system-grid .item__body .content',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $image_icon = $settings['image_icon'];
        $list = $settings['list'];

        if ( empty( $list ) ) {
            return;
        }
    ?>
        <div class="element-system-grid">
            <?php foreach ( $list as $item ) : ?>

            <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                <?php if ( !empty( $item['list_image']['id'] ) ) : ?>
                    <div class="item__thumbnail">
                        <?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="item__body">
                    <?php if ( !empty( $image_icon['id'] ) ) : ?>
                        <div class="image-icon">
                            <?php echo wp_get_attachment_image( $image_icon['id'], 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $item['list_title'] ) : ?>
                        <h3 class="title">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ( $item['list_content'] ) : ?>
                        <div class="content">
                            <?php echo wpautop( $item['list_content'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
    <?php
    }
}