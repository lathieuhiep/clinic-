<?php
$phone = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
$chat_zalo = clinic_get_chat_zalo();
?>

<div class="contact-us-mobile">
    <div class="warp">
        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/chan-trang-lien-he.jpg' ) ) ?>" alt="">

        <?php if ( !empty( $chat_zalo['phone'] ) ) : ?>
            <a class="item zalo<?php echo esc_attr( $chat_zalo['class'] ); ?>"
               href="<?php echo esc_url( $chat_zalo['link'] ) ?>"
               data-phone="<?php echo esc_attr( clinic_preg_replace_ony_number( $chat_zalo['phone'] ) ); ?>"
               data-qr-code="<?php echo esc_attr( $chat_zalo['qr_code'] ); ?>"
               target="<?php echo esc_attr( $chat_zalo['target'] ); ?>"
            ></a>
        <?php endif; ?>

        <?php if ( $phone ) : ?>
            <a class="item phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>"></a>
        <?php endif; ?>

        <?php if ( $link_chat ) : ?>
            <a class="item chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank"></a>
        <?php endif; ?>
    </div>
</div>