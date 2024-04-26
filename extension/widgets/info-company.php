<?php
/**
 * Widget Name: Info Company Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class clinic_info_company_widget extends WP_Widget {
	/* Widget setup */
    public function __construct() {
        $clinic_info_company_widget_ops = array(
            'classname'     =>  'info-company-widget',
            'description'   =>  esc_html__( 'A widget that displays your info company', 'clinic' ),
        );

        parent::__construct( 'info-company-widget', 'My Theme: Thông tin công ty', $clinic_info_company_widget_ops );
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
        <div class="info-company-widget">
            <?php if ( $instance['address'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.31 1.77619C11.496 1.5989 11.743 1.5 12 1.5C12.2569 1.5 12.504 1.5989 12.69 1.77619L20.69 9.39519L23.19 11.7752C23.3823 11.9582 23.494 12.2101 23.5005 12.4754C23.5071 12.7408 23.408 12.9979 23.225 13.1902C23.042 13.3825 22.7901 13.4942 22.5247 13.5007C22.2594 13.5073 22.0023 13.4082 21.81 13.2252L21 12.4522V20.0002C21 20.5306 20.7893 21.0393 20.4142 21.4144C20.0391 21.7895 19.5304 22.0002 19 22.0002H4.99999C4.46955 22.0002 3.96085 21.7895 3.58577 21.4144C3.2107 21.0393 2.99999 20.5306 2.99999 20.0002V12.4522L2.18999 13.2242C1.99797 13.4072 1.74112 13.5064 1.47594 13.5C1.21077 13.4937 0.958985 13.3822 0.775986 13.1902C0.592986 12.9982 0.493761 12.7413 0.500137 12.4762C0.506513 12.211 0.617969 11.9592 0.809986 11.7762L3.30999 9.39519L11.31 1.77519V1.77619ZM4.99999 10.5482V20.0002H8.99999V15.0002C8.99999 14.2045 9.31606 13.4415 9.87867 12.8789C10.4413 12.3163 11.2043 12.0002 12 12.0002C12.7956 12.0002 13.5587 12.3163 14.1213 12.8789C14.6839 13.4415 15 14.2045 15 15.0002V20.0002H19V10.5482L12 3.88019L4.99999 10.5472V10.5482ZM13 20.0002V15.0002C13 14.735 12.8946 14.4806 12.7071 14.2931C12.5196 14.1055 12.2652 14.0002 12 14.0002C11.7348 14.0002 11.4804 14.1055 11.2929 14.2931C11.1053 14.4806 11 14.735 11 15.0002V20.0002H13Z" fill="white"/>
                        </svg>
                    </div>

                    <div class="item__content">
                        <?php echo esc_html( $instance['address'] ); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ( $instance['hotline'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.9989 1.93311C6.4759 1.93311 1.9989 6.36458 1.9989 11.831C1.9989 13.2503 2.31889 14.6639 2.93689 15.9757C2.11689 20.1675 2.02991 20.5535 2.02991 20.5535C1.89591 21.24 2.49189 21.8279 3.18689 21.698C3.18689 21.698 3.5659 21.633 7.8429 20.8319C9.1339 21.4392 10.5649 21.7289 11.9989 21.7289C17.5219 21.7289 21.9989 17.2974 21.9989 11.831C21.9989 6.36458 17.5219 1.93311 11.9989 1.93311ZM11.9989 3.91268C16.4169 3.91268 19.9989 7.4578 19.9989 11.831C19.9989 16.2042 16.4169 19.7493 11.9989 19.7493C10.7419 19.7493 9.53489 19.4571 8.43689 18.9141C8.24089 18.8175 8.02591 18.7811 7.81091 18.8214C4.26091 19.4865 4.5429 19.4468 4.2489 19.5018C4.3069 19.2073 4.25689 19.513 4.93689 16.0376C4.97889 15.8224 4.9419 15.5838 4.8429 15.3881C4.2849 14.2937 3.9989 13.0856 3.9989 11.831C3.9989 7.4578 7.5809 3.91268 11.9989 3.91268ZM9.18689 6.88204C8.24889 6.88204 6.9989 8.11928 6.9989 9.0472C6.9989 10.2431 8.2489 12.4496 9.4989 13.6868C9.6339 13.82 9.9889 14.1723 10.1239 14.3054C11.3739 15.5427 13.6029 16.7799 14.8109 16.7799C15.7489 16.7799 16.9989 15.5427 16.9989 14.6148C16.9989 13.6868 15.7489 12.4496 14.8109 12.4496C14.4989 12.4496 13.3679 13.0895 13.2489 13.0682C12.2529 12.8902 10.9569 11.5764 10.7489 10.5937C10.7199 10.4566 11.3739 9.35651 11.3739 9.0472C11.3739 8.11928 10.1239 6.88204 9.18689 6.88204Z" fill="white"/>
                        </svg>
                    </div>

                    <div class="item__content">
                        <?php echo esc_html( $instance['hotline'] ); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ( $instance['facebook'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.08334 6.25037C2.08334 5.14525 2.52233 4.08539 3.30373 3.30394C4.08513 2.5225 5.14494 2.0835 6.25001 2.0835H18.75C19.8551 2.0835 20.9149 2.5225 21.6963 3.30394C22.4777 4.08539 22.9167 5.14525 22.9167 6.25037V18.751C22.9167 19.8561 22.4777 20.916 21.6963 21.6974C20.9149 22.4789 19.8551 22.9179 18.75 22.9179H6.25001C5.14494 22.9179 4.08513 22.4789 3.30373 21.6974C2.52233 20.916 2.08334 19.8561 2.08334 18.751V6.25037ZM6.25001 4.16693C5.69748 4.16693 5.16757 4.38644 4.77687 4.77716C4.38617 5.16788 4.16668 5.69781 4.16668 6.25037V18.751C4.16668 19.3035 4.38617 19.8335 4.77687 20.2242C5.16757 20.6149 5.69748 20.8344 6.25001 20.8344H12.5V13.5424H11.4583C11.1821 13.5424 10.9171 13.4326 10.7218 13.2373C10.5264 13.0419 10.4167 12.777 10.4167 12.5007C10.4167 12.2244 10.5264 11.9594 10.7218 11.7641C10.9171 11.5687 11.1821 11.459 11.4583 11.459H12.5V9.89638C12.5 8.9294 12.8841 8.00202 13.5679 7.31826C14.2516 6.6345 15.1789 6.25037 16.1458 6.25037H16.7708C17.0471 6.25037 17.3121 6.36012 17.5074 6.55548C17.7028 6.75084 17.8125 7.01581 17.8125 7.29209C17.8125 7.56837 17.7028 7.83333 17.5074 8.02869C17.3121 8.22405 17.0471 8.33381 16.7708 8.33381H16.1458C15.9407 8.33381 15.7375 8.37422 15.5479 8.45275C15.3583 8.53128 15.1861 8.64638 15.041 8.79147C14.8959 8.93657 14.7808 9.10883 14.7023 9.29841C14.6238 9.48799 14.5833 9.69118 14.5833 9.89638V11.459H16.7708C17.0471 11.459 17.3121 11.5687 17.5074 11.7641C17.7028 11.9594 17.8125 12.2244 17.8125 12.5007C17.8125 12.777 17.7028 13.0419 17.5074 13.2373C17.3121 13.4326 17.0471 13.5424 16.7708 13.5424H14.5833V20.8344H18.75C19.3025 20.8344 19.8324 20.6149 20.2232 20.2242C20.6139 19.8335 20.8333 19.3035 20.8333 18.751V6.25037C20.8333 5.69781 20.6139 5.16788 20.2232 4.77716C19.8324 4.38644 19.3025 4.16693 18.75 4.16693H6.25001Z" fill="white"/>
                        </svg>
                    </div>

                    <div class="item__content">
                        <?php echo esc_html( $instance['facebook'] ); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ( $instance['mail'] ) : ?>
                <div class="item">
                    <div class="item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.65013 5.38372C2.91681 5.00858 3.26916 4.70248 3.6779 4.49086C4.08664 4.27925 4.53997 4.16822 5.00024 4.16699H20.001C20.976 4.16699 21.8271 4.6566 22.3511 5.38372C22.7084 5.88166 22.9178 6.49523 22.9178 7.1536V17.8479C22.9178 19.4615 21.6469 20.8345 20.001 20.8345H5.00024C3.35433 20.8345 2.08344 19.4615 2.08344 17.8479V7.1536C2.08344 6.49523 2.29178 5.88166 2.65013 5.38268V5.38372ZM5.13879 6.25043L11.7297 13.506C11.8274 13.6134 11.9464 13.6992 12.0791 13.758C12.2119 13.8167 12.3554 13.847 12.5006 13.847C12.6458 13.847 12.7893 13.8167 12.9221 13.758C13.0548 13.6992 13.1738 13.6134 13.2715 13.506L19.8624 6.25043H5.13879ZM20.8343 8.27969L14.8132 14.9071C14.5203 15.2294 14.1633 15.4868 13.765 15.663C13.3668 15.8392 12.9361 15.9303 12.5006 15.9303C12.0651 15.9303 11.6344 15.8392 11.2362 15.663C10.8379 15.4868 10.4809 15.2294 10.188 14.9071L4.16687 8.27969V17.8479C4.16687 18.3833 4.57522 18.751 5.00024 18.751H20.001C20.426 18.751 20.8343 18.3833 20.8343 17.8479V8.27969Z" fill="white"/>
                        </svg>
                    </div>

                    <div class="item__content">
                        <?php echo esc_html( $instance['mail'] ); ?>
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
            'title' => '',
            'address' => '',
            'hotline' => '',
            'facebook' => '',
            'mail' => '',
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
            <label for="<?php echo $this->get_field_id( 'address' ); ?>">
				<?php esc_html_e( 'Địa chỉ:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'hotline' ); ?>">
				<?php esc_html_e( 'Hotline:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'hotline' ); ?>" name="<?php echo $this->get_field_name( 'hotline' ); ?>" value="<?php echo $instance['hotline']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
				<?php esc_html_e( 'Facebook:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'mail' ); ?>">
				<?php esc_html_e( 'Mail:', 'clinic' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'mail' ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" value="<?php echo $instance['mail']; ?>" />
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
        $instance['address'] = strip_tags( $new_instance['address'] );
        $instance['hotline'] = strip_tags( $new_instance['hotline'] );
        $instance['facebook'] = strip_tags( $new_instance['facebook'] );
        $instance['mail'] = strip_tags( $new_instance['mail'] );

        return $instance;
    }
}

// Register widget
function clinic_info_company_widget_register(): void {
    register_widget( 'clinic_info_company_widget' );
}

add_action( 'widgets_init', 'clinic_info_company_widget_register' );