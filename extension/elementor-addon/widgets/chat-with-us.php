<?php

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Chat_With_Us extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name(): string
	{
		return 'clinic-chat-with-us';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title(): string
	{
		return esc_html__('Chat vs chúng tôi', 'clinic');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-mail';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords(): array
	{
		return ['contact' ];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories(): array
	{
		return ['my-theme'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls(): void
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'clinic' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'clinic' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'NỀN TẢNG HỖ TRỢ', 'clinic' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'more_options',
			[
				'label' => esc_html__( 'Link chat được thiết lập trong theme options', 'clinic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render(): void
	{
		$settings = $this->get_settings_for_display();

		$chat_messenger = clinic_get_opt_link_chat_messenger();
		$chat_doctor = clinic_get_opt_link_chat_doctor();
		$chat_zalo = clinic_get_opt_chat_zalo();

		$owl_options = [
			'dots' => true,
			'margin' => 12,
			'responsive' => [
				'0' => [
					'items' => '1'
				],
				'576' => [
					'items' => '2'

				],
				'768' => [
					'items' => '3'
				],
			]
		];
	?>
		<div class="element-chat-with-us">
			<h2 class="heading f-family-body">
				<span><?php echo esc_html( $settings['heading'] ); ?></span>
			</h2>

			<div class="element-chat-with-us__warp owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
				<?php if ( $chat_messenger ) : ?>
				<div class="item">
					<a class="link" href="<?php echo esc_url( $chat_messenger ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/chat-facebook.png' ) ) ?>" alt="">
					</a>
				</div>
				<?php endif; ?>

				<?php if ( $chat_doctor ) : ?>
					<div class="item">
						<a class="link" href="<?php echo esc_url( $chat_doctor ); ?>" target="_blank">
							<img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/chat-online.png' ) ) ?>" alt="">
						</a>
					</div>
				<?php endif; ?>

				<?php
				if ( !empty( $chat_zalo ) ) :
					$zalo_type = $chat_zalo['select_zalo'];
					$zalo_phone = $chat_zalo['phone'];
					$zalo_qr_code = $chat_zalo['qr_code'];
					$zalo_link = $chat_zalo['link'];
                ?>
                    <div class="item">
                        <?php if ( $zalo_type == 'phone_qr' ) : ?>
                            <a class="link chat-zalo-open" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
                                <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/chat-zalo.png' ) ) ?>" alt="">
                            </a>
                        <?php else: ?>
                            <a class="link" href="<?php echo esc_url( $zalo_link ); ?>" target="_blank">
                                <img src="<?php echo esc_url( get_theme_file_uri( '/extension/elementor-addon/images/chat-zalo.png' ) ) ?>" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	<?php
	}
}