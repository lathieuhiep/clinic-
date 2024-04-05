<?php
$phone = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
$chat_zalo = clinic_get_opt_chat_zalo();
?>

<div class="contact-us-group d-md-none">
    <img class="thumbnail" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gif/contact.gif' ) ) ?>" alt="contact">

    <?php if ( $phone ) : ?>
        <a class="phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>"></a>
    <?php endif; ?>

    <?php
    if ( $chat_zalo ) :
        $zalo_phone = $chat_zalo['phone'];
        $zalo_qr_code = $chat_zalo['qr_code'];
    ?>
        <a class="chat chat-with-us__zalo" href="#" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>"></a>
    <?php endif; ?>
</div>