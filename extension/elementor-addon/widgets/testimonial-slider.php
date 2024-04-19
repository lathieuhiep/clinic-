<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Testimonial_Slider extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'clinic-testimonial-slider';
    }

    public function get_title(): string {
        return esc_html__( 'Testimonial Slider', 'clinic' );
    }

    public function get_icon(): string {
        return 'eicon-user-circle-o';
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

        $repeater = new Repeater();

	    $repeater->add_control(
		    'list_image',
		    [
			    'label' => esc_html__( 'Choose Image', 'clinic' ),
			    'type' => Controls_Manager::MEDIA,
			    'default' => [
				    'url' => Utils::get_placeholder_image_src(),
			    ],
		    ]
	    );

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Name', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Anh L.T.D' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_description',
            [
                'label' => esc_html__( 'Description', 'clinic' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'GEMs are robotics algorithm for modules that built & optimized for NVIDIA AGX Data should underlie every business decision. Data should underlie every business Yet too often some very down the certain routes.', 'clinic' ),
                'placeholder' => esc_html__( 'Type your description here', 'clinic' ),
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

        // tab style description
        $this->start_controls_section(
            'style_description',
            [
                'label' => esc_html__( 'Description', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_control(
		    'desc_color',
		    [
			    'label'     =>  esc_html__( 'Color', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-testimonial-slider .item .desc' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'desc_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-testimonial-slider .item .desc',
		    ]
	    );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

	    $owl_options = [
            'responsive' => [
                '0' => [
                    'items' => '1',
                    'margin' => 12,
                ],
                '768' => [
	                'items' => '2',
	                'margin' => 12,
                ],
                '992' => [
	                'items' => '2',
	                'margin' => 24,
                ],
                '1200' => [
	                'items' => '2',
	                'margin' => 50,
                ]
            ]
	    ];
    ?>

        <div class="element-testimonial-slider">
            <div class="element-testimonial-slider__warp owl-carousel owl-theme custom-equal-height-owl" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
                <?php
                foreach ( $settings['list'] as $item ) :
                    $imageId = $item['list_image']['id'];
                ?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="thumbnail">
                            <?php
                            if ( $imageId ) :
                                echo wp_get_attachment_image( $item['list_image']['id'], 'full' );
                            else:
                            ?>
                                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/user-avatar.png' ) ) ?>" alt="<?php echo esc_attr( $item['list_title'] ); ?>" />
                            <?php endif; ?>
                        </div>

                        <div class="desc">
                            <?php echo wp_kses_post( $item['list_description'] ) ?>
                        </div>

                        <p class="name text-center">
	                        <?php echo esc_html( $item['list_title'] ); ?>
                        </p>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    <?php
    }
}