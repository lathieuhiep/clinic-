<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Safety_Principles extends Widget_Base
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
        return 'clinic-safety-principles';
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
        return esc_html__('Quy trình khám chữa', 'clinic');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string {
        return 'eicon-text';
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
        return ['image', 'text', 'list'];
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
        // image
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Ảnh', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'textdomain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // list
        $this->start_controls_section(
            'list_section',
            [
                'label' => esc_html__( 'Danh sách quy tắc', 'clinic' ),
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
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Tiêu đề #1', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #2', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #3', 'clinic' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #4', 'clinic' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // container style
        $this->start_controls_section(
            'container_section_style',
            [
                'label' => esc_html__( 'Vùng chứa', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
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
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .repeater-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label' => esc_html__( 'Màu nền', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .repeater-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .repeater-item',
            ]
        );

        $this->add_control(
            'container_border_radius',
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
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .repeater-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .repeater-item',
            ]
        );

        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'style_title_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_title_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'clinic' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'clinic' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Center', 'clinic' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Right', 'clinic' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' =>  esc_html__( 'Justify', 'clinic' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_title_color',
            [
                'label' => esc_html__( 'Color', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .title',
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
                'default' => 'text-justify',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     =>  esc_html__( 'Color', 'clinic' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-safety-principles__warp .item-group .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'clinic' ),
                'selector' => '{{WRAPPER}} .element-safety-principles__warp .item-group .content',
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
        $list = $settings['list'];

        $listFirst = $listLast = [];
        if ( !empty( $list ) ) {
            $size = ceil(count($list) / 2);
            $listChuck = array_chunk($list, $size, true);

            $listFirst = $listChuck[0];
            $listLast = $listChuck[1] ?? [];
        }

        // theme options
        $link_chat = clinic_get_opt_link_chat_doctor();
        $medical_appointment_form = clinic_get_opt_medical_appointment();

        ?>
        <div class="element-safety-principles">
            <div class="element-safety-principles__warp">
                <?php $this->listContent($listFirst, 'item-left', $settings); ?>

                <div class="item item-thumbnail">
                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                </div>

                <?php $this->listContent($listLast, 'item-right', $settings); ?>
            </div>

            <?php if ( !empty( $medical_appointment_form ) || !empty( $link_chat ) ) : ?>
                <div class="action-box d-flex align-items-center justify-content-center text-uppercase">
                    <?php if ( !empty( $link_chat ) ) : ?>
                        <a class="action-box__chat" href="<?php echo esc_url( $link_chat ); ?>">
                            <?php esc_html_e('click để được tư vấn', 'clinic'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ( !empty( $medical_appointment_form ) ) : ?>
                        <a class="action-box__booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                            <?php esc_html_e('click để đặt lịch khám', 'clinic'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function listContent($list, $class, $settings): void {
        ?>
        <div class="item item-group <?php echo esc_attr( $class ); ?>">
            <?php
            if ( $list ) :
                foreach ( $list as $key => $item):
                    ?>
                    <div class="repeater-item text-end-lg elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <h4 class="title">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </h4>

                        <div class="content <?php echo esc_attr( $settings['content_align'] ); ?>">
                            <?php echo wpautop( $item['list_content'] ); ?>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
        <?php
    }
}