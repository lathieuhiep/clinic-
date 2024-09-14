<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Category_List extends Widget_Base
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
        return 'clinic-category-list';
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
        return esc_html__('Category List', 'clinic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-post-list';
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
        return ['list', 'category' ];
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
                    '{{WRAPPER}} .element-category-list__grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid-column-gap',
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
                    '{{WRAPPER}} .element-category-list__grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid-row-gap',
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
                    '{{WRAPPER}} .element-category-list__grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Title', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__( 'Image', 'clinic' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_custom_link',
            [
                'label' => esc_html__( 'Link mở rộng', 'clinic' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Có', 'clinic' ),
                'label_off' => esc_html__( 'Không', 'clinic' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'list_category',
            [
                'label' => esc_html__( 'Danh mục', 'clinic' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => clinic_check_get_cat('category'),
                'condition' => [
                    'list_custom_link' => '',
                ],
            ]
        );

        $repeater->add_control(
            'list_link',
            [
                'label' => esc_html__( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'list_custom_link' => 'yes',
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

        // item style
        $this->start_controls_section(
            'item_style_section',
            [
                'label' => esc_html__('Danh sách', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_padding',
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
                    '{{WRAPPER}} .element-category-list__grid .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .element-category-list__grid .item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .element-category-list__grid .item',
            ]
        );

        $this->add_control(
            'item_border_radius',
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
                    '{{WRAPPER}} .element-category-list__grid .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // box image style
        $this->start_controls_section(
            'box_image_style_section',
            [
                'label' => esc_html__('Hộp chứa ảnh', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_image_margin',
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
                    '{{WRAPPER}} .element-category-list__grid .item__image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_image_height',
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
                    '{{WRAPPER}} .element-category-list__grid .item__image' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_image_alignment',
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
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-category-list__grid .item__image' => 'text-align: {{VALUE}};',
                ]
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
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-category-list__grid .item .title' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Màu', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-category-list__grid .item .title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Màu di chuyển', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-category-list__grid .item:hover .title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-category-list__grid .item .title',
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
        <div class="element-category-list">
            <?php if ( $settings['list'] ) : ?>
                <div class="element-category-list__grid">
                    <?php foreach ( $settings['list'] as $index => $item) : ?>
                        <div class="item">
                            <?php
                            if ( $item['list_custom_link'] !== 'yes' ) :
                                $link = get_category_link( $item['list_category'] );
                            ?>
                                <a class="item__link" href="<?php echo esc_url( $link ); ?>"></a>
                            <?php
                            else :
                                if ( !empty( $item['list_link']['url'] ) ) :
                                    $link_key = 'link_' . $index;
                                    $this->add_link_attributes( $link_key, $item['list_link'] );
                            ?>
                                    <a class="item__link" <?php $this->print_render_attribute_string( $link_key ); ?>></a>
                            <?php
                                endif;
                            endif;
                            ?>

                            <div class="item__image">
                                <?php echo wp_get_attachment_image( $item['list_image']['id'], 'medium_large'); ?>
                            </div>

                            <div class="item__body">
                                <h4 class="title f-family-body">
                                    <?php echo esc_html( $item['list_title'] ) ?>
                                </h4>

                                <div class="desc">
                                    <?php echo category_description( $item['list_category'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php

                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}