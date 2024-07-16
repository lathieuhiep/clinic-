<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Doctor_Slider extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'clinic-doctor-slider';
	}

	public function get_title(): string {
		return esc_html__( 'Doctor Slider', 'clinic' );
	}

	public function get_icon(): string {
		return 'eicon-slider-push';
	}

	protected function register_controls(): void {
        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
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

        $this->end_controls_section();

		// query section
		$this->start_controls_section(
			'query_section',
			[
				'label' => esc_html__( 'Query', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'limit',
			[
				'label'     =>  esc_html__( 'Number of Posts', 'clinic' ),
				'type'      =>  Controls_Manager::NUMBER,
				'default'   =>  12,
				'min'       =>  1,
				'max'       =>  100,
				'step'      =>  1,
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'     =>  esc_html__( 'Order By', 'clinic' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'id',
				'options'   =>  [
					'id'    =>  esc_html__( 'ID', 'clinic' ),
					'title' =>  esc_html__( 'Title', 'clinic' ),
					'date'  =>  esc_html__( 'Date', 'clinic' ),
					'rand'  =>  esc_html__( 'Random', 'clinic' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'     =>  esc_html__( 'Order', 'clinic' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'DESC',
				'options'   =>  [
					'ASC'   =>  esc_html__( 'Ascending', 'clinic' ),
					'DESC'  =>  esc_html__( 'Descending', 'clinic' ),
				],
			]
		);

		$this->end_controls_section();

        // style heading
        $this->start_controls_section(
            'heading_section_style',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-doctor-slider .heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-doctor-slider .heading',
            ]
        );

        $this->end_controls_section();

        // style name
        $this->start_controls_section(
            'name_section_style',
            [
                'label' => esc_html__( 'Tên', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-doctor-slider__warp .item__body .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .element-doctor-slider__warp .item__body .title',
            ]
        );

        $this->end_controls_section();

        // style specialist
        $this->start_controls_section(
            'specialist_section_style',
            [
                'label' => esc_html__( 'Chuyên khoa', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'specialist_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-doctor-slider__warp .item__body .specialist' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'specialist_typography',
                'selector' => '{{WRAPPER}} .element-doctor-slider__warp .item__body .specialist',
            ]
        );

        $this->end_controls_section();

        // style content
        $this->start_controls_section(
            'content_section_style',
            [
                'label' => esc_html__( 'Nội dung', 'clinic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Màu chữ', 'clinic' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-doctor-slider__warp .item__body .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .element-doctor-slider__warp .item__body .content',
            ]
        );

        $this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

        $medical_appointment_form = clinic_get_opt_medical_appointment();
        $link_chat = clinic_get_opt_link_chat_doctor();

		$limit_post     =   $settings['limit'];
		$order_by_post  =   $settings['order_by'];
		$order_post     =   $settings['order'];

		// Query
		$args = array(
			'post_type'           => 'clinic_doctor',
			'posts_per_page'      => $limit_post,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
        ?>
            <div class="element-doctor-slider">
                <div class="top-box">
                    <h2 class="heading">
                        <?php echo esc_html( $settings['heading'] ); ?>
                    </h2>
                </div>

                <div class="element-doctor-slider__warp owl-carousel owl-theme">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

						$specialist = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_specialist', true);
                    ?>

                        <div class="item">
                            <div class="item__thumbnail">
								<?php the_post_thumbnail('large'); ?>
                            </div>

                            <div class="item__body">
                                <h3 class="title text-uppercase">
									<?php the_title(); ?>
                                </h3>

                                <h4 class="specialist text-uppercase">
                                    <?php echo esc_html( $specialist ); ?>
                                </h4>

                                <?php if ( !empty( get_the_content() ) ) : ?>
                                    <div class="content">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="action-box">
                                    <?php if ( !empty( $medical_appointment_form ) ) : ?>
                                        <a class="action-box__booking text-uppercase d-inline-block" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                            <img src="<?php echo esc_url( get_theme_file_uri('extension/elementor-addon/images/btn-hen-kham.png') ) ?>" alt="">
                                        </a>
                                    <?php endif; ?>

                                    <?php if ( !empty( $link_chat ) ) : ?>
                                        <a class="action-box__chat text-uppercase d-inline-block" href="<?php echo esc_url( $link_chat ); ?>">
                                            <img src="<?php echo esc_url( get_theme_file_uri('extension/elementor-addon/images/btn-bs-tu-van.png') ) ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

					<?php
					endwhile;
					wp_reset_postdata();
					?>
                </div>
            </div>
		<?php
		endif;
	}
}