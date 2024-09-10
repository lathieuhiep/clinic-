<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Support extends Widget_Base
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
        return 'clinic-support';
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
        return esc_html__('Hỗ trợ', 'clinic');
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
        return 'eicon-headphones';
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
        return ['support', 'chat'];
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
        // heading
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'clinic' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Link chat, zalo, số điện thoại được thiết lập ở theme options', 'clinic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'text_chat',
            [
                'label'       => esc_html__( 'Văn bản chat', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'chuyên gia tư vấn online, hỗ trợ giải đáp 24/7', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_zalo',
            [
                'label'       => esc_html__( 'Văn bản zalo', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tư vấn qua', 'clinic' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_hotline',
            [
                'label'       => esc_html__( 'Văn bản hotline', 'clinic' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'tư vấn qua hotline:', 'clinic' ),
                'label_block' => true,
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

        // theme options
        $link_chat = clinic_get_opt_link_chat_doctor();
        $chat_zalo = clinic_get_opt_chat_zalo();
        $hotline = clinic_get_opt_hotline();

    ?>
        <div class="element-support">
            <div class="item chat">
                <a class="link" href="<?php echo esc_url( $link_chat ) ?>" target="_blank"></a>

                <div class="icon">
                    <img src="<?php echo esc_url( get_theme_file_uri('/extension/elementor-addon/images/chat-online.webp') ); ?>" alt="">
                </div>

                <div class="content">
                    <?php echo esc_html( $settings['text_chat'] ); ?>
                </div>
            </div>

            <div class="item zalo">
                <?php
                if ( !empty( $chat_zalo ) ) :
                    $zalo_selcet = $chat_zalo['select_zalo'];

                    if ( $zalo_selcet == 'phone_qr' ) :
                        $zalo_phone = $chat_zalo['phone'];
                        $zalo_qr_code = $chat_zalo['qr_code'];
                        ?>
                        <a class="link chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>"></a>
                    <?php else: ?>
                        <a class="link" href="<?php echo esc_url( $chat_zalo['link'] ); ?>" target="_blank"></a>
                    <?php
                    endif;
                endif;
                ?>

                <div class="content">
                    <?php echo esc_html( $settings['text_zalo'] ); ?>
                </div>

                <div class="icon">
                    <img src="<?php echo esc_url( get_theme_file_uri('/extension/elementor-addon/images/chat-zalo.webp') ); ?>" alt="">
                </div>
            </div>

            <div class="item hotline">
                <a class="link" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ) ?>"></a>

                <div class="content">
                    <?php echo esc_html( $settings['text_hotline'] ); ?>
                </div>

                <div class="value">
                    <?php echo esc_html( $hotline ); ?>
                </div>
            </div>
        </div>
    <?php
    }
}