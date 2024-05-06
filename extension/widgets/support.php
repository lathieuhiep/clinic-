<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class clinic_support_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $clinic_working_time_widget_ops = array(
            'classname'     =>  'support-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
        );

        parent::__construct( 'support-widget', 'My Theme: Hỗ trợ', $clinic_working_time_widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // theme options
        $link_chat = clinic_get_opt_link_chat_doctor();
        $hotline = clinic_get_opt_hotline();
        $medical_appointment_form = clinic_get_opt_medical_appointment();
        $link_map = clinic_get_opt_general_address_link();
    ?>

        <div class="warp">
            <?php if ( !empty( $link_chat ) ) : ?>
                <div class="item link-chat">
                    <a href="<?php echo esc_url( $link_chat ); ?>">
                        <i class="icon icon-chat"></i>

                        <span><?php esc_html_e('Tư vấn miễn phí', 'clinic'); ?></span>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $hotline ) ) : ?>
                <div class="item hotline">
                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>" target="_blank">
                        <i class="icon icon-phone"></i>

                        <span><?php esc_html_e('Hotline:', 'clinic'); echo ' ' . esc_html( $hotline ); ?></span>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $medical_appointment_form ) ) : ?>
                <div class="item contact">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                        <i class="icon icon-calendar"></i>

                        <span><?php esc_html_e('Đặt lịch hẹn khám', 'clinic'); ?></span>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $link_map ) ) : ?>
                <div class="item link-map">
                    <a href="<?php echo esc_url( $link_map ); ?>" target="_blank">
                        <i class="icon icon-location"></i>

                        <span><?php esc_html_e('Chỉ đường', 'clinic'); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    <?php

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    function form( $instance ) {
        $defaults = array(
            'title' => '',
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <?php esc_html_e('Thông tin liên hệ được thiết lập trong theme options'); ?>
        </p>
        <?php

    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }
}

// Register widget
function clinic_support_widget_register(): void {
    register_widget( 'clinic_support_widget' );
}

add_action( 'widgets_init', 'clinic_support_widget_register' );