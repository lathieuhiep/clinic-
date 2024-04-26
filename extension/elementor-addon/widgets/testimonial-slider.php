<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class clinic_Elementor_Addon_Testimonial_Slider extends Widget_Base {
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
                'default' => esc_html__( 'Chị Ng.M.A' , 'clinic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_info',
            [
                'label'         =>  esc_html__( 'Info', 'clinic' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__('25 Tuổi, Hải Châu, Đà Nẵng'),
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

	    // tab style name
	    $this->start_controls_section(
		    'style_name',
		    [
			    'label' => esc_html__( 'Name', 'clinic' ),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control(
		    'name_color',
		    [
			    'label'     =>  esc_html__( 'Color', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-testimonial-slider .item .content .name' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'name_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-testimonial-slider .item .content .name',
		    ]
	    );

	    $this->end_controls_section();

        // tab style info
	    $this->start_controls_section(
		    'style_info',
		    [
			    'label' => esc_html__( 'Info', 'clinic' ),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control(
		    'info_color',
		    [
			    'label'     =>  esc_html__( 'Color', 'clinic' ),
			    'type'      =>  Controls_Manager::COLOR,
			    'selectors' =>  [
				    '{{WRAPPER}} .element-testimonial-slider .item .content .group-content .info' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'info_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-testimonial-slider .item .content .group-content .info',
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
				    '{{WRAPPER}} .element-testimonial-slider .item .content .group-content .desc' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'desc_typography',
			    'label' => esc_html__( 'Typography', 'clinic' ),
			    'selector' => '{{WRAPPER}} .element-testimonial-slider .item .content .group-content .desc',
		    ]
	    );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>

        <div class="element-testimonial-slider">
            <div class="element-testimonial-slider__warp">
                <?php
                foreach ( $settings['list'] as $item ) :
                    $imageId = $item['list_image']['id'];
                ?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="item__warp">
                            <figure class="image">
		                        <?php
		                        if ( $imageId ) :
			                        echo wp_get_attachment_image( $item['list_image']['id'], 'full' );
		                        else:
                                ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/user-avatar.png' ) ) ?>" alt="<?php echo esc_attr( $item['list_title'] ); ?>" />
		                        <?php endif; ?>
                            </figure>

                            <div class="content">
                                <div class="box">
                                    <div class="name">
				                        <?php echo esc_html( $item['list_title'] ); ?>
                                    </div>

                                    <div class="group-content">
                                        <div class="info fw-bold">
					                        <?php echo esc_html( $item['list_info'] ); ?>
                                        </div>

                                        <div class="desc">
					                        <?php echo wp_kses_post( $item['list_description'] ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    <?php
    }
}