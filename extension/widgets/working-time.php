<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class clinic_working_time_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $clinic_working_time_widget_ops = array(
            'classname'     =>  'working-time-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
        );

        parent::__construct( 'working-time-widget', 'My Theme: Thời gian làm việc', $clinic_working_time_widget_ops );
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
        ?>
        <div class="warp">
            <div class="time">
                <?php echo esc_html($instance['open_hours']); ?>
            </div>

            <div class="arrive">
                <span class="arrive__line"></span>
                <span class="arrive__txt text-uppercase"><?php esc_html_e('Đến'); ?></span>
                <span class="arrive__line"></span>
            </div>

            <div class="time">
                <?php echo esc_html($instance['closed_hours']); ?>
            </div>

            <div class="note text-center">
                <p>
                    <?php esc_html_e('Làm việc không ngày nghỉ, có dịch vụ thăm khám về đêm', 'clinic'); ?>
                </p>
            </div>
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
            'open_hours' => '07 : 30',
            'closed_hours' => '20 : 00',
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Tiêu đề:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'open_hours' ); ?>">
                <?php esc_html_e( 'Giờ mở cửa phòng khám:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'open_hours' ); ?>" name="<?php echo $this->get_field_name( 'open_hours' ); ?>" value="<?php echo $instance['open_hours']; ?>" style="margin-bottom: 12px" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'closed_hours' ); ?>">
                <?php esc_html_e( 'Giờ đóng cửa phòng khám:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'closed_hours' ); ?>" name="<?php echo $this->get_field_name( 'closed_hours' ); ?>" value="<?php echo $instance['closed_hours']; ?>" style="margin-bottom: 12px" />
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
        $instance['open_hours'] = strip_tags( $new_instance['open_hours'] );
        $instance['closed_hours'] = strip_tags( $new_instance['closed_hours'] );

        return $instance;
    }
}

// Register widget
function clinic_working_time_widget_register(): void {
    register_widget( 'clinic_working_time_widget' );
}

add_action( 'widgets_init', 'clinic_working_time_widget_register' );