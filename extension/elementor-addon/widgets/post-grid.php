<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class clinic_Elementor_Addon_Post_Grid extends Widget_Base
{
    public function get_categories(): array {
        return array('my-theme');
    }

    public function get_name(): string {
        return 'clinic-post-grid';
    }

    public function get_title(): string {
        return esc_html__('Posts Grid', 'clinic');
    }

    public function get_icon(): string {
        return 'eicon-gallery-grid';
    }

    protected function register_controls(): void {

        // Content query
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Query', 'clinic'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label' => esc_html__('Select Category Link', 'clinic'),
                'type' => Controls_Manager::SELECT2,
                'options' => clinic_check_get_cat('category'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of Posts', 'clinic'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 100,
                'step' => 1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => esc_html__('Order By', 'clinic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__('Post ID', 'clinic'),
                    'author' => esc_html__('Post Author', 'clinic'),
                    'title' => esc_html__('Title', 'clinic'),
                    'date' => esc_html__('Date', 'clinic'),
                    'rand' => esc_html__('Random', 'clinic'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'clinic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'clinic'),
                    'DESC' => esc_html__('Descending', 'clinic'),
                ],
            ]
        );

        $this->end_controls_section();

        // Content layout
        $this->start_controls_section(
            'content_layout',
            [
                'label' => esc_html__('Layout Settings', 'clinic'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label' => esc_html__('Column', 'clinic'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    1 => esc_html__('1 Column', 'clinic'),
                    2 => esc_html__('2 Column', 'clinic'),
                    3 => esc_html__('3 Column', 'clinic'),
                    4 => esc_html__('4 Column', 'clinic'),
                ],
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show excerpt', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Yes', 'clinic'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('No', 'clinic'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__('Excerpt Words', 'clinic'),
                'type' => Controls_Manager::NUMBER,
                'default' => '10',
                'condition' => [
                    'show_excerpt' => 'show',
                ],
            ]
        );

        $this->end_controls_section();

        // Style title
        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__('Title', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post__title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post__title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__title',
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => esc_html__('Title Alignment', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'clinic'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'clinic'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'clinic'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'clinic'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__title' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Style excerpt
        $this->start_controls_section(
            'style_excerpt',
            [
                'label' => esc_html__('Excerpt', 'clinic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'show',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Color', 'clinic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__content p',
            ]
        );

        $this->add_control(
            'excerpt_alignment',
            [
                'label' => esc_html__('Excerpt Alignment', 'clinic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'clinic'),
                        'icon' => 'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' => esc_html__('Center', 'clinic'),
                        'icon' => 'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' => esc_html__('Right', 'clinic'),
                        'icon' => 'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' => esc_html__('Justified', 'clinic'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__content p' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $cat_post = $settings['select_cat'];
        $limit_post = $settings['limit'];
        $order_by_post = $settings['order_by'];
        $order_post = $settings['order'];

        // Query
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit_post,
            'orderby' => $order_by_post,
            'order' => $order_post,
            'ignore_sticky_posts' => 1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            ?>

            <div class="element-post-grid">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-<?php echo esc_attr( $settings['column_number'] ); ?>">
                    <?php while ($query->have_posts()): $query->the_post(); ?>

                        <div class="col">
                            <div class="item-post">
                                <div class="item-post__thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php
                                        if (has_post_thumbnail()) :
                                            the_post_thumbnail('large');
                                        else:
                                            ?>
                                            <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/no-image.png')) ?>"
                                                 alt="<?php the_title(); ?>"/>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="item-post__box">
                                    <h3 class="title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <?php if ($settings['show_excerpt'] == 'show') : ?>
                                        <div class="content">
                                            <p>
                                                <?php
                                                if (has_excerpt()) :
                                                    echo esc_html(wp_trim_words(get_the_excerpt(), $settings['excerpt_length'], '...'));
                                                else:
                                                    echo esc_html(wp_trim_words(get_the_content(), $settings['excerpt_length'], '...'));
                                                endif;
                                                ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>

                                    <a class="read-more" href="<?php the_permalink(); ?>">
                                        <?php esc_html_e('Xem thêm', 'clinic'); ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M18 12L8 12" stroke="#3C9159" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21.6427 11.7856L18.2116 9.72696C17.6784 9.40703 17 9.79112 17 10.413V13.587C17 14.2089 17.6784 14.593 18.2116 14.273L21.6427 12.2144C21.8045 12.1173 21.8045 11.8827 21.6427 11.7856Z" fill="#3C9159"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

                <?php if ( $cat_post ) : ?>
                    <div class="action-box text-center">
                        <a class="btn-link-cate" href="<?php echo esc_url(get_category_link($cat_post)); ?>">
			                <?php esc_html_e('xem thêm bài viết', 'clinic'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php

        endif;
    }

}