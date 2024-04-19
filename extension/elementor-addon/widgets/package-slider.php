<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Package_Slider extends Widget_Base
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
		return 'clinic-package-slider';
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
		return esc_html__('Gói khám', 'clinic');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-slider-device';
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
		return ['package', 'slider' ];
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

		$repeater = new Repeater();

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Ảnh gói khám', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tên gói', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_price',
			[
				'label' => esc_html__( 'Giá (.000đ)', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'min' => 1,
				'step' => 1,
				'default' => esc_html__( '188' , 'clinic' ),
			]
		);

        $repeater->add_control(
			'list_promotional_price',
			[
				'label' => esc_html__( 'Giá khuyến mãi (.000đ)', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'min' => 0,
				'step' => 1,
				'default' => '',
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Mô tả gói khám', 'clinic' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content' , 'clinic' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Danh sách gói khám', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Tiêu đề #1', 'clinic' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Tiêu đề #2', 'clinic' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style price
		$this->start_controls_section(
			'style_price_section',
			[
				'label' => esc_html__( 'Price', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .element-package-slider__warp .item__content .linear-gradient',
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
		$medical_appointment_form = clinic_get_opt_medical_appointment();

		$owl_options = [
			'items' => 1,
			'autoHeight' => true
		];
	?>
		<div class="element-package-slider">
			<div class="element-package-slider__warp owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
				<?php
				foreach ( $settings['list'] as $item ) :
					$imageId = $item['list_image']['id'];
                    $price = $item['list_price'];

                    if ( $item['list_promotional_price'] ) {
	                    $price = $item['list_promotional_price'];
                    }
				?>

					<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<div class="item__thumbnail">
							<?php
							if ( $imageId ) :
								echo wp_get_attachment_image( $imageId, 'full' );
							endif;
							?>
						</div>

						<div class="item__content">
							<h3 class="title">
								<?php echo esc_html( $item['list_title'] ); ?>
							</h3>

							<div class="price d-flex align-items-end">
                                <div class="price__current d-flex align-items-end">
                                    <p class="number linear-gradient" data-text="<?php echo esc_html( $price ); ?>">
                                        <?php echo esc_html( $price ); ?>
                                    </p>

                                    <p class="txt">
                                        <span class="unit linear-gradient" data-text=".000đ">.000đ</span>
                                        <span class="only"><?php esc_html_e('Chỉ với', 'clinic'); ?></span>
                                    </p>
                                </div>

                                <?php if ( $item['list_promotional_price'] ) : ?>
                                    <div class="price__old">
                                        <p class="txt">
                                            <?php esc_html_e('Giá gốc', 'clinic'); ?>
                                        </p>

                                        <p class="number">
                                            <?php echo esc_html( $item['list_price'] ); ?><span>.000đ</span>
                                        </p>
                                    </div>
                                <?php endif; ?>
							</div>

							<div class="desc">
								<?php echo wpautop( $item['list_content'] ) ?>
							</div>

							<?php if ( $medical_appointment_form ) : ?>
								<div class="action-box">
									<a class="action-box__booking" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
										<i class="icon-calendar"></i>
										<span><?php esc_html_e('ĐẶT LỊCH KHÁM', 'clinic'); ?></span>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}