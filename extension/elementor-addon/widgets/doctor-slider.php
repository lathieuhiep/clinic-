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
            <div class="element-doctor-slider__gallery">
                <?php
                while ( $query->have_posts() ):
                    $query->the_post();
                    $avatar = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_avatar', true);
	                $content = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_content', true);

	                $contentArr = [];
                    if ( $content ) {
	                    $contentArr = array_filter(explode(PHP_EOL, $content));
                    }
                ?>

                    <div class="item" data-thumb="<?php echo esc_url( $avatar ); ?>">
                        <div class="item__grid">
                            <div class="thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>

                            <div class="info">
                                <div class="info__top">
                                    <p class="position">
		                                <?php echo esc_html( get_post_meta(get_the_ID(), 'clinic_cmb_doctor_position', true) ); ?>
                                    </p>

                                    <h3 class="name">
		                                <?php the_title(); ?>
                                    </h3>

                                    <p class="specialist">
		                                <?php echo esc_html( get_post_meta(get_the_ID(), 'clinic_cmb_doctor_specialist', true) ); ?>
                                    </p>
                                </div>

                                <?php if ( $contentArr ) : ?>
                                    <ul class="reset-list content">
                                        <?php foreach ( $contentArr as $itemContent) : ?>
                                        <li>
                                            <i class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.45 2.61249C14.7785 2.61249 18.2875 6.12146 18.2875 10.45C18.2875 14.7785 14.7785 18.2875 10.45 18.2875C6.12147 18.2875 2.6125 14.7785 2.6125 10.45C2.6125 6.12146 6.12147 2.61249 10.45 2.61249Z" fill="url(#paint0_linear_47_72)"/>
                                                    <path d="M15.0219 10.45H5.87813" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M10.45 5.87811V15.0219" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_47_72" x1="10.45" y1="2.61249" x2="10.45" y2="18.2875" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#FF0000"/>
                                                            <stop offset="1" stop-color="#CA1212"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </i>
                                            <span><?php echo esc_html( $itemContent ); ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <div class="action-box text-center">
	                                <?php if ( $medical_appointment_form ) : ?>

                                    <a class="action-box__booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/dat-lich-kham.png' ) ) ?>" alt="">
                                    </a>

	                                <?php
                                    endif;

                                    if ( $link_chat ) :
                                    ?>

                                    <a class="action-box__support" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/bac-si-tu-van.png' ) ) ?>" alt="">
                                    </a>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <button type="button" class="btn doctor-slider-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 18L6 12L12 6" stroke="#222222"/>
                    <path d="M18 18L12 12L18 6" stroke="#222222"/>
                </svg>
            </button>

            <button type="button" class="btn doctor-slider-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M12 18.7538L18 12.5025L12 6.25128" stroke="#222222"/>
                    <path d="M6 18.7538L12 12.5025L6 6.25128" stroke="#222222"/>
                </svg>
            </button>
        </div>
    <?php

        endif;
    }

}