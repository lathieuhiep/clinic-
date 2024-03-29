<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class clinic_consulting_doctor_widget extends WP_Widget {
	/* Widget setup */
	public function __construct() {
		$clinic_widget_ops = array(
			'classname'     =>  'consulting-doctor-widget',
			'description'   =>  esc_html__( 'A widget that displays', 'clinic' ),
		);

		parent::__construct( 'consulting-doctor-widget', 'My Theme: Bác sĩ tư vấn', $clinic_widget_ops );
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

		$hotline = clinic_get_opt_hotline();
	?>

		<div class="warp">
            <div class="top-box">
                <h3 class="heading text-uppercase m-0">
                    <?php esc_html_e('Bác sĩ tư vấn', 'clinic'); ?>
                </h3>

                <p class="txt text-uppercase">
	                <?php esc_html_e('Miễn phí', 'clinic'); ?>
                </p>
            </div>

            <a class="phone" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                <i class="icon-phone-circle"></i>
                <span><?php echo esc_html( $hotline ); ?></span>
            </a>

            <p class="note">
                <?php esc_html_e( '“Lấy nghề cứu người, lấy tâm luyện đức”', 'clinic' ); ?>
            </p>
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
			'title' => '',
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
			<?php esc_html_e('Số điện thoại được thiết lập ở theme optíon', 'clinic'); ?>
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

		return $instance;
	}
}

// Register widget
function clinic_consulting_doctor_widget_register(): void {
	register_widget( 'clinic_consulting_doctor_widget' );
}

add_action( 'widgets_init', 'clinic_consulting_doctor_widget_register' );