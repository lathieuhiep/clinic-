<?php
$chat_zalo = clinic_get_chat_zalo();
$link_messenger = clinic_get_opt_link_chat_messenger();
$call_phone = clinic_get_opt_hotline();
?>

<div class="chat-with-us">
	<?php if ( !empty( $chat_zalo['phone'] ) ) : ?>
        <a class="link zalo<?php echo esc_attr( $chat_zalo['class'] ); ?>"
           href="<?php echo esc_url( $chat_zalo['link'] ) ?>"
           data-phone="<?php echo esc_attr( clinic_preg_replace_ony_number( $chat_zalo['phone'] ) ); ?>"
           data-qr-code="<?php echo esc_attr( $chat_zalo['qr_code'] ); ?>"
           target="<?php echo esc_attr( $chat_zalo['target'] ); ?>"
        >
            <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>

    <?php if ( $link_messenger ) : ?>
        <a class="link chat-with-us__messenger" href="<?php echo esc_url($link_messenger); ?>" target="_blank">
            <img alt="facebook" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/mess-facebook-contact.png' ) ) ?>" width="50" height="" />
        </a>
    <?php endif; ?>

	<?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone alo-circle-anim" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($call_phone)); ?>">
            <img alt="phone" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/phone-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>
</div>