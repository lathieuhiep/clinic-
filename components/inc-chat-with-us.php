<?php
$call_phone = clinic_get_opt_hotline();
$link_messenger = clinic_get_opt_link_chat_messenger()
?>

<div class="chat-with-us">
    <a class="link icon" href="https://zalo.me/4019565536704794124" target="_blank">
        <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="50" />
    </a>

    <?php if ( $link_messenger ) : ?>
        <a class="link chat-with-us__messenger icon" href="<?php echo esc_url($link_messenger); ?>" target="_blank">
            <img alt="facebook" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/mess-facebook-contact.png' ) ) ?>" width="50" height="50" />
        </a>
    <?php endif; ?>

    <?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone icon" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($call_phone)); ?>">
            <img alt="phone" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/phone-icon-contact.png' ) ) ?>" width="50" height="50" />
        </a>
    <?php endif; ?>
</div>