<?php
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$chat_zalo = clinic_get_opt_chat_zalo();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
            <div class="logo">
                <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'full' );
                    else :
                        ?>

                        <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>
            </div>

            <div class="info">
                <div class="item d-flex align-items-center">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-sun.png') ); ?>" alt="">
                    </div>

                    <div class="item__content">
                        <p><?php esc_html_e('Giờ làm việc hàng ngày', 'clinic'); ?></p>

                        <strong><?php echo esc_html( $working_time ); ?></strong>
                    </div>
                </div>

                <div class="item item-zalo">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-zalo-chat.png') ); ?>" alt="">
                    </div>

                    <div class="item__content">
                        <?php if ( !empty( $chat_zalo ) ) : ?>
                            <p><?php esc_html_e('Click tư vấn', 'clinic'); ?></p>

                            <?php
                            $zalo_selcet = $chat_zalo['select_zalo'];

                            if ( $zalo_selcet == 'phone_qr' ) :
                                $zalo_phone = $chat_zalo['phone'];
                                $zalo_qr_code = $chat_zalo['qr_code'];
                                ?>
                                <a class="link chat-zalo text-uppercase fw-bold" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
                                    <?php esc_html_e( 'Miễn phí qua zalo', 'clinic' ); ?>
                                </a>
                            <?php else: ?>
                                <a class="link text-uppercase fw-bold" href="<?php echo esc_url( $chat_zalo['link'] ); ?>" target="_blank">
                                    <?php esc_html_e( 'Miễn phí qua zalo', 'clinic' ); ?>
                                </a>
                            <?php
                            endif;
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <div class="search-box">
                <?php get_search_form() ?>
            </div>
        </div>
    </div>
</div>