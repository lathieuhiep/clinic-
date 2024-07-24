<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Company_Info extends Widget_Base
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
        return 'clinic-company-info';
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
        return esc_html__('Thông tin công ty', 'clinic');
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
        return 'eicon-gallery-group';
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
        return ['image', 'text', 'info'];
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
        // gallery section
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Gallery', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => esc_html__( 'Thêm ảnh', 'clinic' ),
                'type' => Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        // time section
        $this->start_controls_section(
            'time_section',
            [
                'label' => esc_html__( 'Thời gian làm việc', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'describe_time',
            [
                'label'       => esc_html__( 'Mô tả', 'clinic' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Phòng khám làm việc tất cả các ngày trong tuần', 'clinic' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'working_time',
            [
                'label'       => esc_html__( 'Thời gian hoạt động', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '7h30 - 20h', 'clinic' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'note_time',
            [
                'label'       => esc_html__( 'Lưu ý', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'kể cả ngày lễ và chủ nhật', 'clinic' ),
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        // address section
        $this->start_controls_section(
            'address_section',
            [
                'label' => esc_html__( 'Địa chỉ', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'describe_address',
            [
                'label'       => esc_html__( 'Mô tả', 'clinic' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( '180 Trần Phú Phước Ninh, Hải Châu, ĐN', 'clinic' ),
                'label_block' => true
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_phone', [
                'label' => esc_html__( 'Số điện thoại', 'clinic' ),
                'type' => Controls_Manager::TEXT,
                'default' => '0888.888.115',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Danh sách', 'clinic' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_phone' => '0888.888.115',
                    ],
                    [
                        'list_phone' => '024.888.11115',
                    ],
                ],
                'title_field' => '{{{ list_phone }}}',
            ]
        );

        $this->add_control(
            'website_url',
            [
                'label'       => esc_html__( 'Địa chỉ website', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'chuyenbenhtri.com',
                'label_block' => true
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
    ?>
        <div class="element-company-info">
            <div class="element-company-info__warp">
                <div class="item item-gallery">
                    <?php
                    if ( !empty( $settings['gallery'] ) ) :
                        foreach ( $settings['gallery'] as $item ):
                    ?>
                        <div class="thumbnail">
                            <?php echo wp_get_attachment_image( $item['id'], 'full' ); ?>
                        </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <div class="item item-info text-center">
                    <div class="info-box item-info__time">
                        <h4 class="title text-uppercase">
                            <?php esc_html_e('thời gian làm việc', 'clinic'); ?>
                        </h4>

                        <div class="desc">
                            <?php echo wpautop( $settings['describe_time'] ); ?>
                        </div>

                        <div class="working working-time">
                            <?php echo esc_html( $settings['working_time'] ) ?>
                        </div>

                        <div class="note">
                            <?php echo wpautop( $settings['note_time'] ); ?>
                        </div>
                    </div>

                    <div class="info-box item-info__address">
                        <h4 class="title text-uppercase">
                            <?php esc_html_e('địa chỉ, liên hệ', 'clinic'); ?>
                        </h4>

                        <div class="desc">
                            <?php echo wpautop( $settings['describe_address'] ); ?>
                        </div>

                        <div class="working phone">
                            <?php if ( $settings['list'] ) : ?>
                                <div class="icon">
                                    <i class="icon icon-phone-circle"></i>
                                </div>

                                <div class="list-phone">
                                    <?php foreach ( $settings['list'] as $phone) : ?>
                                        <a class="item-phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number( $phone['list_phone']) ); ?>">
                                            <?php echo esc_html( $phone['list_phone'] ); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="note">
                            <i class="icon-globe"></i>

                            <a href="<?php echo esc_url( $settings['website_url'] ) ?>">
                                <?php echo esc_html( $settings['website_url'] ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}