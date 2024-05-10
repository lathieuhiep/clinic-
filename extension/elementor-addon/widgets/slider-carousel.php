<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Slider_Carousel extends Widget_Base
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
        return 'clinic-slider-carousel';
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
        return esc_html__('Slider Carousel', 'clinic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-slider-push';
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
        return ['slider', 'carousel' ];
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
        // list
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
            'list_image',
            [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
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
                        'list_title' => esc_html__( 'Tiêu đề #1', 'clinic' ),
                        'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Tiêu đề #2', 'clinic' ),
                        'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // carousel options
        $this->start_controls_section(
            'options_section',
            [
                'label' => esc_html__( 'Tùy chọn bổ sung', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Lặp lại vô hạn', 'clinic'),
                'label_off'     =>  esc_html__('Không', 'clinic'),
                'label_on'      =>  esc_html__('Có', 'clinic'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         =>  esc_html__('Tự động chạy', 'clinic'),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_off'     =>  esc_html__('Không', 'clinic'),
                'label_on'      =>  esc_html__('Có', 'clinic'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Thanh điều hướng', 'clinic' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both'  => esc_html__( 'Mũi tên và Dấu chấm', 'clinic' ),
                    'arrows'  => esc_html__( 'Mũi tên', 'clinic' ),
                    'dots'  => esc_html__( 'Dấu chấm', 'clinic' ),
                    'none' => esc_html__( 'Không', 'clinic' ),
                ],
            ]
        );

        $this->end_controls_section();

        // responsive
        $this->start_controls_section(
            'responsive_section',
            [
                'label' => esc_html__( 'Responsive', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // min width 1200
        $this->add_control(
            'min_width_1200',
            [
                'label'     => esc_html__( 'Min Width 1200px', 'basictheme' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_1200',
            [
                'label'   => esc_html__( 'Number of Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'margin_item_1200',
            [
                'label'   => esc_html__( 'Khoảng cách', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 24,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        // min width 992
        $this->add_control(
            'min_width_992',
            [
                'label'     => esc_html__( 'Min Width 992px', 'basictheme' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_992',
            [
                'label'   => esc_html__( 'Number of Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'margin_item_992',
            [
                'label'   => esc_html__( 'Khoảng cách', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 24,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        // min width 768
        $this->add_control(
            'min_width_768',
            [
                'label'     => esc_html__( 'Min Width 768px', 'basictheme' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_768',
            [
                'label'   => esc_html__( 'Number of Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'margin_item_768',
            [
                'label'   => esc_html__( 'Khoảng cách', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        // min width 576
        $this->add_control(
            'min_width_576',
            [
                'label'     => esc_html__( 'Min Width 576px', 'basictheme' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_576',
            [
                'label'   => esc_html__( 'Number of Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'margin_item_576',
            [
                'label'   => esc_html__( 'Space Between Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,
                'min'     => 0,
                'max'     => 10,
                'step'    => 1,
            ]
        );

        // max width 575
        $this->add_control(
            'max_width_575',
            [
                'label'     => esc_html__( 'Max Width 575px', 'basictheme' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_575',
            [
                'label'   => esc_html__( 'Number of Item', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'margin_item_575',
            [
                'label'   => esc_html__( 'Khoảng cách', 'basictheme' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1,
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

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'clinic' ),
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
                    '{{WRAPPER}} .element-slider-carousel__warp .item__body .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'clinic' ),
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
                    '{{WRAPPER}} .element-slider-carousel__warp .item__body .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_align',
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
                'default' => 'text-center',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-slider-carousel__warp .item__body .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-slider-carousel__warp .item__body .title',
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

        $owl_options = [
            'loop'       => ( 'yes' === $settings['loop'] ),
            'nav'        => $settings['navigation'] == 'both' || $settings['navigation'] == 'arrows',
            'dots'       => $settings['navigation'] == 'both' || $settings['navigation'] == 'dots',
            'autoplay'   => ( 'yes' === $settings['autoplay'] ),
            'responsive' => [
                '0' => array(
                    'items'  => $settings['item_575'],
                    'margin' => $settings['margin_item_575']
                ),

                '576' => array(
                    'items'  => $settings['item_576'],
                    'margin' => $settings['margin_item_576']
                ),

                '768' => array(
                    'items' => $settings['item_768'],
                    'margin' => $settings['margin_item_768'],
                ),

                '992' => array(
                    'items' => $settings['item_992'],
                    'margin' => $settings['margin_item_992'],
                ),

                '1200' => array(
                    'items' => $settings['item_1200'],
                    'margin' => $settings['margin_item_1200'],
                ),
            ],
        ];
    ?>
        <div class="element-slider-carousel">
            <div class="element-slider-carousel__warp owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
                <?php
                foreach ( $settings['list'] as $item ) :
                    $imageId = $item['list_image']['id'];
                ?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="item__thumbnail">
                            <?php
                            if ( $imageId ) :
                                echo wp_get_attachment_image( $imageId, 'large' );
                            endif;
                            ?>
                        </div>

                        <div class="item__body">
                            <h3 class="title <?php echo esc_attr( $settings['title_align'] ); ?>">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </h3>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}