<?php
/**
 * Widget Name: Social Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class clinic_social_widget extends WP_Widget {
	/* Widget setup */
    public function __construct() {
        $clinic_social_widget_ops = array(
            'classname'     =>  'social-widget',
            'description'   =>  esc_html__( 'A widget that displays your social icons', 'clinic' ),
        );

        parent::__construct( 'social-widget', 'My Theme: Social Icons', $clinic_social_widget_ops );
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

        $social_network = clinic_get_option( 'opt_social_network' );

        if ( empty( $social_network) ) {
            return;
        }
    ?>
        <div class="widget-warp">
            <strong class="txt text-uppercase"><?php esc_html_e('Theo dõi chúng tôi qua'); ?></strong>

            <ul class="social-list">
                <?php foreach ( $social_network as $item) :?>
                <li>
                    <a href="<?php echo esc_url( $item['url'] ) ?>" target="_blank">
                        <?php echo wp_get_attachment_image($item['icon']['id']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
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
            'title' => esc_html__('Subscribe & Follow', 'clinic')
        );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Title:', 'clinic' ); ?>
            </label>

			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
            <?php esc_html_e( 'chú ý: Mạng xã hộiược thiết lập trong theme options', 'clinic' ); ?>
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

// Register social widget
function clinic_social_widget_register(): void {
    register_widget( 'clinic_social_widget' );
}

add_action( 'widgets_init', 'clinic_social_widget_register' );