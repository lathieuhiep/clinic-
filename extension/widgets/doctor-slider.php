<?php
/**
 * Widget Name: doctor slider Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class clinic_doctor_slider_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $clinic_open_hours_widget_ops = array(
            'classname'     =>  'doctor-slider-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
        );

        parent::__construct( 'widget-doctor-slider', 'My Theme: Doctor Slider', $clinic_open_hours_widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ): void
    {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // Query
        $limit = $instance['number'] ?? 10;

        $query_args = array(
            'post_type' => 'clinic_doctor',
            'posts_per_page' => $limit,
            'orderby' => $instance['order_by'],
            'order' => $instance['order'],
            'ignore_sticky_posts' => 1,
        );

        $query = new WP_Query( $query_args );

        if ( $query->have_posts() ) :
    ?>
        <div class="owl-carousel owl-theme">
            <?php
            while ( $query->have_posts() ) :
                $query->the_post();

                $position = get_post_meta(get_the_ID(), 'clinic_cmb_doctor_position', true);
            ?>

            <div class="item">
                <figure class="item__thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </figure>

                <div class="item__body text-center">
                    <h3 class="title">
                        <?php the_title(); ?>
                    </h3>

                    <p class="position">
                        <?php echo esc_html( $position ); ?>
                    </p>

                    <div class="desc">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php
        endif;

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    function form( $instance ): void
    {
        $defaults = array(
            'title' => '',
            'order' => 'DESC'
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
        $order      = $instance['order'];
        $order_by   = $instance['order_by'] ?? 'ID';
        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Tiêu đề:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <!-- Start Order -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                <?php esc_html_e( 'Order:', 'clinic' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
                    name="<?php echo $this->get_field_name( 'order' ) ?>" class="widefat">
                <option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ASC', 'clinic' ); ?>
                </option>

                <option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'DESC', 'clinic' ); ?>
                </option>
            </select>
        </p>

        <!-- Start OrderBy -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
                <?php esc_html_e( 'Order:', 'clinic' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"
                    name="<?php echo $this->get_field_name( 'order_by' ) ?>" class="widefat">
                <option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ID', 'clinic' ); ?>
                </option>

                <option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Date', 'clinic' ); ?>
                </option>

                <option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Title', 'clinic' ); ?>
                </option>

                <option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Rand', 'clinic' ); ?>
                </option>
            </select>
        </p>

        <!-- Start Number Post Show -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
                <?php esc_html_e( 'Number of posts to show:', 'clinic' ); ?>
            </label>

            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text"
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
                   value="<?php echo esc_attr( $number ); ?>" size="3"/>
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
    function update( $new_instance, $old_instance ): array
    {
        $instance = array();

        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['order']      = $new_instance['order'];
        $instance['order_by']   = $new_instance['order_by'];
        $instance['number']     = (int) $new_instance['number'];

        return $instance;
    }
}

// Register widget
function clinic_doctor_slider_widget_register(): void {
    register_widget( 'clinic_doctor_slider_widget' );
}

add_action( 'widgets_init', 'clinic_doctor_slider_widget_register' );