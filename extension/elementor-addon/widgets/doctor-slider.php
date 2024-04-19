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
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$medical_appointment_form = clinic_get_opt_medical_appointment();

		$owl_options = [
			'items' => 1,
            'dots' => false
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
            $avatars = [];
        ?>
            <div class="element-doctor-slider">
                <div class="element-doctor-slider__warp owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

                    $avatar = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_avatar_id', true);
                    $position = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_position', true);
                    $specialist = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_specialist', true);

                    $avatars[] = $avatar;
                    ?>

                    <div class="item">
                        <div class="item__thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>

                        <div class="item__body">
                            <h3 class="title text-uppercase text-center">
                                <?php echo esc_html( $position ) . ' '; the_title(); ?>
                            </h3>

                            <p class="position text-uppercase text-center">
                                <?php echo esc_html( $specialist ); ?>
                            </p>

                            <div class="content">
                                <?php the_content(); ?>
                            </div>

	                        <?php if ( $medical_appointment_form ) : ?>
                                <div class="action-box">
                                    <a class="action-box__booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                        <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/btn-hen-kham.png' ) ) ?>" alt="">
                                    </a>
                                </div>
	                        <?php endif; ?>
                        </div>
                    </div>

					<?php
					endwhile;
					wp_reset_postdata();
					?>
                </div>

                <?php if ( !empty( $avatars ) ) : ?>
                    <div class="element-doctor-avatar">
                        <div class="element-doctor-avatar__slider owl-carousel owl-theme">
	                        <?php foreach ($avatars as $avatar) : ?>
                                <div class="item">
	                                <?php echo wp_get_attachment_image( $avatar, 'full' ); ?>
                                </div>
	                        <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
		<?php
		endif;
	}
}