<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

class Clinic_Elementor_More_Information extends Widget_Base
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
		return 'clinic-more-information';
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
		return esc_html__('Thông tin thêm', 'clinic');
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
		return 'eicon-gallery-grid';
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
		return ['image', 'content', 'box' ];
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
			'style',
			[
				'label' => esc_html__( 'Chọn Kiểu', 'clinic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__( 'Kiểu 1', 'clinic' ),
					'style-2' => esc_html__( 'Kiểu 2', 'clinic' ),
				],
			]
		);

		$this->add_control(
			'show_btn_contact',
			[
				'label' => esc_html__( 'Hiển thị button liên hệ', 'clinic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Hiện', 'clinic' ),
				'label_off' => esc_html__( 'Ẩn', 'clinic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tiêu đề', 'clinic' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'show_underline_title',
			[
				'label' => esc_html__( 'Gạch chân tiêu đề', 'clinic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Hiện', 'clinic' ),
				'label_off' => esc_html__( 'Ẩn', 'clinic' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'content',
            [ 
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'type' => Controls_Manager::WYSIWYG,
				'rows' => 8,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// style title
		$this->start_controls_section(
			'style_title_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_title_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-more-information__warp .item .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_title_typography',
				'selector' => '{{WRAPPER}} .element-more-information__warp .item .title',
			]
		);

		$this->end_controls_section();

		// style content
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Nội dung', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_content_color',
			[
				'label' => esc_html__( 'Color', 'clinic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-more-information__warp .item .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_content_typography',
				'selector' => '{{WRAPPER}} .element-more-information__warp .item .desc',
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

        // add attribute title
		$this->add_render_attribute( 'title', 'class', 'title' );

        if (  $settings['show_underline_title'] === 'yes' ) {
	        $this->add_render_attribute( 'title', 'class', 'underline' );
        }
	?>
		<div class="element-more-information">
			<div class="element-more-information__warp <?php echo esc_attr( $settings['style'] ); ?>">
				<div class="item item-thumbnail">
					<?php echo wp_get_attachment_image( $settings['image']['id'], 'large' ); ?>
                </div>

                <div class="item item-content">
                    <h3 <?php $this->print_render_attribute_string( 'title' ); ?>>
	                    <?php echo esc_html($settings['title']); ?>
                    </h3>

                    <div class="desc">
	                    <?php echo wpautop($settings['content']); ?>
                    </div>

                    <?php
                    if ( $settings['show_btn_contact'] === 'yes' ) :
	                    $medical_appointment_form = clinic_get_opt_medical_appointment();
	                    $link_chat = clinic_get_opt_link_chat_doctor();
                    ?>
                    <div class="action-box">
                        <?php if ( $link_chat ) : ?>
                            <a class="action-box__link" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
		                        <?php esc_html_e('Gặp bác sĩ tư vấn', 'clinic'); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ( $medical_appointment_form ) : ?>
                            <!-- Button trigger modal -->
                            <a class="action-box__book" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
		                        <?php esc_html_e('Đặt lịch hẹn khám', 'clinic'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
			</div>
		</div>
		<?php
	}
}