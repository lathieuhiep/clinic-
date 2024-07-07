<?php
$phone = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
?>

<div class="contact-us-mobile d-lg-none">
    <div class="warp">
        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/chan-trang-nam-khoa.gif' ) ) ?>" alt="">

        <?php if ( $phone ) : ?>
            <a class="item phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>"></a>
        <?php endif; ?>

        <?php if ( $link_chat ) : ?>
            <a class="item chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank"></a>
        <?php endif; ?>
    </div>
</div>