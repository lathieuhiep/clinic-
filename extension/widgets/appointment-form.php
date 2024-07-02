<?php
/**
 * Widget Name: Info Company Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class clinic_appointment_form_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $clinic_appointment_form_widget_ops = array(
            'classname'     =>  'appointment-form-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
        );

        parent::__construct( 'appointment-form-widget', 'My Theme: Đặt lịch hẹn', $clinic_appointment_form_widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ): void {
        $qrCodeZalo = clinic_get_opt_chat_qr_code_zalo();

        echo $args['before_widget'];
        ?>
        <div class="image-box">
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/dang-ki-nhan-tu-van.png' ) ) ?>" alt="">
        </div>
        <?php
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
        <div class="widget-warp">
            <?php
            if ( $instance['select_form'] ) :
                echo do_shortcode( '[contact-form-7 id="' . $instance['select_form'] . '" ]' );
            endif;
            ?>

            <?php if ( !empty( $qrCodeZalo ) ) : ?>
                <div class="qr-code">
                    <p class="note-text m-0">
                        <strong><?php esc_html_e('Quét mã QR', 'clinic'); ?></strong> <?php esc_html_e('bên cạnh để nhanh chóng nhận tư vấn qua Zalo', 'clinic'); ?>
                    </p>

                    <div class="image-box">
                        <?php echo wp_get_attachment_image($qrCodeZalo['id'], 'large'); ?>
                    </div>
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
    function form( $instance ): void {
        $defaults = array(
            'title' => esc_html__('ĐẶT HẸN VỚI BÁC SĨ', 'clinic'),
            'select_form' => ''
        );

        $select_form = $instance['select_form'] ?? '0';
        $cf7_list = clinic_get_form_cf7();

        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Tiêu đề:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'select_form' ) ); ?>">
                <?php esc_html_e( 'Chọn form liên hệ:', 'clinic' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'select_form' ) ); ?>" name="<?php echo $this->get_field_name( 'select_form' ) ?>" class="widefat">
                <?php foreach ( $cf7_list as $key => $value ) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php echo( $select_form == $key ? 'selected="selected"' : '' ); ?>>
                        <?php echo esc_html( $value ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
    function update( $new_instance, $old_instance ): array {
        $instance = array();

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['select_form'] = $new_instance['select_form'];

        return $instance;
    }
}

// Register widget
function clinic_appointment_form_widget_register(): void {
    register_widget( 'clinic_appointment_form_widget' );
}

add_action( 'widgets_init', 'clinic_appointment_form_widget_register' );