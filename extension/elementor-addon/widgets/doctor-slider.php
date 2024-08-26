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
		// Content section
		$this->start_controls_section(
			'content_section',
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

        // Options section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Cài đặt thêm', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Hiển thị tên bác sĩ', 'clinic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Hiện', 'clinic' ),
				'label_off' => esc_html__( 'Ẩn', 'clinic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_position',
			[
				'label' => esc_html__( 'Hiển thị chức vụ', 'clinic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Hiện', 'clinic' ),
				'label_off' => esc_html__( 'Ẩn', 'clinic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$medical_appointment_form = clinic_get_opt_medical_appointment();

		$owl_options = [
			'dots' => false,
			'margin' => 24,
			'responsive' => [
				'0' => array(
					'items'  => 1,
					'margin' => 12
				),

				'576' => array(
					'items'  => 2,
					'margin' => 12
				),

				'768' => array(
					'items' => 3
				),

				'992' => array(
					'items' => 4
				)
			],
		];

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
            <div class="element-doctor-slider__warp owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();

                    $position = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_position', true);
                ?>
                    <div class="item">
                        <div class="item__thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>

                        <?php if ( $settings['show_title'] == 'yes' || $settings['show_position'] == 'yes' ) : ?>
                            <div class="item__info">
		                        <?php if ( $settings['show_title'] == 'yes' ) : ?>
                                    <h3 class="name">
				                        <?php the_title(); ?>
                                    </h3>
		                        <?php endif; ?>

		                        <?php if ( $settings['show_position'] == 'yes' ) : ?>
                                    <p class="position">
				                        <?php echo esc_html( $position ); ?>
                                    </p>
		                        <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="item__action">
	                        <?php if ( $medical_appointment_form ) : ?>
                                <button class="btn btn-contact" type="button" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                    <?php esc_html_e('Tư vấn', 'clinic'); ?>
                                </button>
	                        <?php endif; ?>

                            <button class="btn btn-doctor-detail" type="button" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
	                            <span class="txt"><?php esc_html_e('Xem thêm', 'clinic'); ?></span>
                                <i class="icon icon-setting"></i>
                            </button>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <!-- Modal -->
            <div class="modal fade modal-doctor-detail" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title"></h3>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body"></div>

                        <div class="modal-footer">
		                    <?php if ( $medical_appointment_form ) : ?>
                                <button class="btn btn-contact-modal" type="button" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
				                    <?php esc_html_e('Đăng ký khám', 'clinic'); ?>
                                </button>
		                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
		endif;
	}
}