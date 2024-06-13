<?php
$banner = clinic_get_option('opt_general_banner');
?>

<div class="section-banner">
    <?php if ( !empty( $banner ) ) : ?>
        <?php echo wp_get_attachment_image( $banner['id'], 'full' ); ?>
    <?php endif; ?>
</div>
