<?php
$phone     = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
$chat_zalo = clinic_get_opt_chat_zalo();
?>
<div class="single-contact-us <?php echo esc_attr( $args['class'] ?? '' ); ?>">
    <?php
    if ( $chat_zalo ) :
        $zalo_phone = $chat_zalo['phone'];
        $zalo_qr_code = $chat_zalo['qr_code'];
    ?>
        <a class="item chat-with-us__zalo" href="#" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
            <img class="logo-default"
                 src="<?php echo esc_url( get_theme_file_uri( '/assets/images/chat-voi-bac-si.png' ) ) ?>"
                 alt="<?php echo esc_attr('chat'); ?>" />
        </a>
    <?php endif; ?>

	<a class="item phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
        <img class="logo-default"
             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/goi.png' ) ) ?>"
             alt="<?php echo esc_attr('phone'); ?>" />
	</a>
</div>