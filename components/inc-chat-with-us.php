<?php
$call_phone = clinic_get_opt_hotline();
$chat_zalo = clinic_get_opt_chat_zalo();
$link_messenger = clinic_get_opt_link_chat_messenger()
?>

<div class="chat-with-us">
    <?php
    if ( $chat_zalo ) :
        $zalo_phone = $chat_zalo['phone'];
        $zalo_qr_code = $chat_zalo['qr_code'];
    ?>
        <a class="link chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr(clinic_preg_replace_ony_number($zalo_phone)); ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
            <img src="data:image/png;base64,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" alt="">
        </a>
    <?php endif; ?>

    <?php if ( $link_messenger ) : ?>
        <a class="link chat-with-us__messenger icon" href="<?php echo esc_url($link_messenger); ?>" target="_blank">
            <i class="icon-facebook-messenger"></i>
        </a>
    <?php endif; ?>

    <?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone icon" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($call_phone)); ?>">
            <i class="icon-phone alo-circle-anim"></i>
        </a>
    <?php endif; ?>
</div>