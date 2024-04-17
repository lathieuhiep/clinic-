<?php
$phone = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
$chat_zalo = clinic_get_opt_chat_zalo();
?>

<div class="contact-us-mobile d-lg-none">
    <div class="warp">
        <?php if ( $link_chat ) : ?>
            <div class="item chat">
                <a href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gif/messger.gif' ) ) ?>" alt="">
                </a>
            </div>
        <?php endif; ?>

        <?php if ( $phone ) : ?>
            <div class="item phone">
                <a href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gif/hotline.gif' ) ) ?>" alt="">
                </a>
            </div>
        <?php endif; ?>

        <?php
        if ( $chat_zalo ) :
            $zalo_phone = $chat_zalo['phone'];
            $zalo_qr_code = $chat_zalo['qr_code'];
        ?>
            <div class="item phone">
                <a class="chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gif/chat-zalo.gif' ) ) ?>" alt="">
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>