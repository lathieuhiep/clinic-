<?php
$phone     = clinic_get_opt_hotline();
$link_chat = clinic_get_opt_link_chat_doctor();
?>
<div class="post-contact-us">
	<?php if ( $phone ) : ?>
		<a class="item" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/post-contact-phone.png' ) ) ?>" alt="" />
		</a>
	<?php endif; ?>

	<?php if ( $link_chat ) : ?>
        <a class="item" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/post-contact-advise.png' ) ) ?>" alt="" />
        </a>
	<?php endif; ?>
</div>