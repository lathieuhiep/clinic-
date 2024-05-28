<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class clinic_contact_us_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $widget_ops = array(
            'classname'     =>  'contact-us-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
        );

        parent::__construct( 'contact-us-widget', 'My Theme: Liên hệ với chúng tôi', $widget_ops );
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
        ?>
            <div class="top-box">
                <div class="icon-box">
                    <img src="<?php echo esc_url(get_theme_file_uri( 'assets/images/icon-lien-he-voi-chung-toi.png' )) ?>" alt="">
                </div>
                
                <?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; ?>
            </div>
        <?php
        }
    ?>
        <div class="widget-warp">
            <?php if ( $instance['phone'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <i class="icon-phone-light"></i>
                    </div>

                    <div class="item__body">
                        <a class="fw-bold content" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $instance['phone'] ) ); ?>">
                            <?php echo esc_html( $instance['phone'] ) . ' '; esc_html_e('(miễn phí)', 'clinic'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $instance['address'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <i class="icon-location"></i>
                    </div>

                    <div class="item__body">
                        <p class="content">
                            <?php echo esc_html( $instance['address'] ); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $instance['time'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <i class="icon-clock"></i>
                    </div>

                    <div class="item__body">
                        <p class="content">
                            <?php echo esc_html( $instance['time'] ); ?>
                        </p>

                        <p class="note">
                            <?php esc_html_e('(tất cả các ngày trong tuần, lễ tết)', 'clinic'); ?>
                        </p>
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
    function form( $instance ) {
        $defaults = array(
            'title' => esc_html__('Liên hệ phòng khám', 'clinic'),
            'phone' => '0888.888.115',
            'address' => esc_html__('163 Nguyễn Văn Cừ, An Hòa, Ninh Kiều, Cần Thơ', 'clinic'),
            'time' => '7:30 - 20:00',
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
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>">
                <?php esc_html_e( 'Điện thoại:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="margin-bottom: 12px" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'address' ); ?>">
                <?php esc_html_e( 'Địa chỉ:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="margin-bottom: 12px" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'time' ); ?>">
                <?php esc_html_e( 'Thời gian làm:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" value="<?php echo $instance['time']; ?>" style="margin-bottom: 12px" />
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
        $instance['phone'] = strip_tags( $new_instance['phone'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        $instance['time'] = strip_tags( $new_instance['time'] );

        return $instance;
    }
}

// Register widget
function clinic_contact_us_widget_register(): void {
    register_widget( 'clinic_contact_us_widget' );
}

add_action( 'widgets_init', 'clinic_contact_us_widget_register' );