<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Work_Time extends Widget_Base {
	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'clinic-work-time';
	}

	public function get_title(): string {
		return esc_html__( 'Work Time', 'clinic' );
	}

	public function get_icon(): string {
		return 'eicon-post-list';
	}

	protected function register_controls(): void {

		// Content testimonial
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
				'label' => esc_html__( 'Choose Image', 'clinic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'clinic' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'THỨ 2 - CHỦ NHẬT' , 'clinic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_sub_title',
			[
				'label'         =>  esc_html__( 'Info', 'clinic' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__('Giờ làm việc của phòng khám'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_description',
			[
				'label' => esc_html__( 'Description', 'clinic' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'SÁNG: 07:30 - 12:00; CHIỀU: 1:30 - 20:00', 'clinic' ),
				'placeholder' => esc_html__( 'Type your description here', 'clinic' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'clinic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'clinic' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'clinic' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// tab style title
		$this->start_controls_section(
			'style_title',
			[
				'label' => esc_html__( 'Title', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     =>  esc_html__( 'Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-work-time__warp .item__box .content .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'clinic' ),
				'selector' => '{{WRAPPER}} .element-work-time__warp .item__box .content .title',
			]
		);

		$this->end_controls_section();

		// tab style sub title
		$this->start_controls_section(
			'style_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     =>  esc_html__( 'Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-work-time__warp .item__box .content .sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' => esc_html__( 'Typography', 'clinic' ),
				'selector' => '{{WRAPPER}} .element-work-time__warp .item__box .content .sub-title',
			]
		);

		$this->end_controls_section();

		// tab style description
		$this->start_controls_section(
			'style_description',
			[
				'label' => esc_html__( 'Description', 'clinic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     =>  esc_html__( 'Color', 'clinic' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-work-time__warp .item__desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Typography', 'clinic' ),
				'selector' => '{{WRAPPER}} .element-work-time__warp .item__desc',
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>

        <div class="element-work-time">
            <div class="element-work-time__warp">
				<?php
				foreach ( $settings['list'] as $item ) :
					$imageId = $item['list_image']['id'];
					?>
                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="item__box">
                            <div class="image">
								<?php echo wp_get_attachment_image( $imageId, 'medium_large' ); ?>
                            </div>

                            <div class="content">
                                <h3 class="title m-0">
		                            <?php echo esc_html( $item['list_title'] ); ?>
                                </h3>

                                <p class="sub-title fw-bold">
									<?php echo esc_html( $item['list_sub_title'] ); ?>
                                </p>
                            </div>
                        </div>

                        <div class="item__desc fw-bold">
							<?php echo esc_html( $item['list_description'] ); ?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>

		<?php
	}
}