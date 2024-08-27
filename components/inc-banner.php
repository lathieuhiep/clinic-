<?php
$banner = clinic_get_option('opt_general_banner');

if ( empty($banner) ) {
    return false;
}
?>

<div class="banner-warp">
    <div class="banner-pc">
        <?php echo wp_get_attachment_image( $banner['id'], 'full' ); ?>
    </div>
</div>
