<?php

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
                <div class="element-doctor-slider__warp owl-carousel custom-equal-height-owl">
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
                                <h3 class="title text-uppercase text-center">
                                    <?php the_title(); ?>
                                </h3>

                                <div class="meta text-center">
                                    <p class="specialist m-0">
                                        <?php echo esc_html( $specialist ); ?>
                                    </p>
                                </div>
                            </div>

                            <?php if ( $link_chat || $medical_appointment_form ) :?>
                                <div class="action-box">
                                    <?php if ( $link_chat ) : ?>
                                        <a class="action-box__chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                                            <?php esc_html_e('Tư vấn ngay', "clinic"); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ( $medical_appointment_form ) : ?>
                                        <a class="action-box__booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                            <?php esc_html_e('Đặt hẹn khám', "clinic"); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
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