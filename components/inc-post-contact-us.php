<?php
$phone     = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
?>
<div class="post-contact-us">
	<?php if ( $phone ) : ?>
		<a class="item phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
			<i class="icon icon-phone-light"></i>
            <span><?php echo esc_html( $phone ); ?></span>
		</a>
	<?php endif; ?>

	<?php if ( $link_chat ) : ?>
        <a class="item link" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
            <i class="icon icon-chat"></i>
            <span><?php esc_html_e('Tư vấn chuyên sâu', 'clinic') ?></span>
        </a>
	<?php endif; ?>
</div>