<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Step_Image_Box extends Widget_Base
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
        return 'clinic-step-image-box';
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
        return esc_html__('Step Image Box', 'clinic');
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
        return ['image', 'list', 'box', 'content' ];
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

	    $this->add_responsive_control(
		    'column',
		    [
			    'label' => esc_html__( 'Cột', 'clinic' ),
			    'type' => Controls_Manager::NUMBER,
			    'min' => 1,
			    'step' => 1,
			    'default' => 3,
			    'selectors' => [
				    '{{WRAPPER}} .element-step-image-box__grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
				    '{{WRAPPER}} .element-step-image-box__grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
				    '{{WRAPPER}} .element-step-image-box__grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->end_controls_section();

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
                'default' => esc_html__( 'Tiêu đề' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image', [
                'label' => esc_html__( 'Chọn ảnh', 'clinic' ),
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
                'default' => esc_html__( 'List Content' , 'clinic' ),
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

        // box style
	    $this->start_controls_section(
		    'box_style_section',
		    [
			    'label' => esc_html__( 'Box', 'clinic' ),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control(
		    'box_background_color',
		    [
			    'label'     =>  esc_html__( 'Màu nền', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-step-image-box__grid .item__box' => 'background-color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'box_border',
			    'selector' => '{{WRAPPER}} .element-step-image-box__grid .item__box',
		    ]
	    );

	    $this->add_control(
		    'box_border_radius',
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
				    '{{WRAPPER}} .element-step-image-box__grid .item__box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
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

	    $this->add_control(
		    'image_padding',
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
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'image_align',
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
			    ],
			    'default' => '',
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
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
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
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->end_controls_section();

        // content + title style
	    $this->start_controls_section(
		    'content_title_style_section',
		    [
			    'label' => esc_html__( 'Vùng chứa tiêu để và nội dung', 'clinic' ),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_responsive_control(
		    'content_title_padding',
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
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'content_title_color',
		    [
			    'label'     =>  esc_html__( 'Màu nền', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .content' => 'background-color: {{VALUE}}',
			    ],
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
			    'label'     =>  esc_html__( 'Màu', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .content .title' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'title_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-step-image-box__grid .item__box .content .title',
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
			    'default' => 'text-center',
		    ]
	    );

	    $this->add_control(
		    'content_color',
		    [
			    'label'     =>  esc_html__( 'Màu', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-step-image-box__grid .item__box .content .desc' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'content_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-step-image-box__grid .item__box .content .desc',
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
        <div class="element-step-image-box">
            <div class="element-step-image-box__grid <?php echo esc_attr( $settings['style_layout'] ); ?>">
                <?php foreach ( $settings['list'] as $key => $item ) : ?>
                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
	                    <?php if ( $settings['style_layout'] == 'style-1' ) : ?>
                            <div class="item__step text-center">
                                <p class="txt">
                                    <span><?php esc_html_e('Bước', 'clinic'); echo ' ' . esc_html($key + 1); ?></span>
                                </p>
                            </div>
                        <?php endif; ?>

                        <div class="item__box d-flex flex-column">
                            <div class="thumbnail <?php echo esc_attr( $settings['image_align'] ); ?>">
                                <?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
                            </div>

                            <div class="content flex-grow-1">
	                            <?php if ( $settings['style_layout'] == 'style-2' ) : ?>
                                    <div class="step d-flex align-items-center justify-content-center">
			                            <?php echo esc_html( addZeroBeforeNumber( esc_html($key + 1) ) ); ?>
                                    </div>
	                            <?php endif; ?>

                                <?php if ( $item['list_title'] ) : ?>
                                    <h3 class="title <?php echo esc_attr( $settings['title_align'] ); ?>">
		                                <?php echo esc_html( $item['list_title'] ); ?>
                                    </h3>
                                <?php endif; ?>

	                            <?php if ( $item['list_content'] ) : ?>
                                    <div class="desc <?php echo esc_attr( $settings['content_align'] ); ?>">
                                        <?php echo wpautop( $item['list_content'] ); ?>
                                    </div>
	                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
    }
}