<?php
$banner_pc = clinic_get_option('opt_general_banner_pc');
$banner_mobile = clinic_get_option('opt_general_banner_mobile');
?>

<div class="banner-warp">
	<?php if ( !empty( $banner_pc ) ) : ?>
		<div class="banner-pc">
			<?php echo wp_get_attachment_image( $banner_pc['id'], 'full' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( !empty( $banner_mobile ) ) : ?>
		<div class="banner-mobile">
			<?php echo wp_get_attachment_image( $banner_mobile['id'], 'full' ); ?>
		</div>
	<?php endif; ?>
</div>
