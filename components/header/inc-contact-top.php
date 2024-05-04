<?php
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
$bk_cf_top = clinic_get_option('opt_general_bk_cf_top');
$cf_top = clinic_get_option('opt_general_cf_top');
?>

<header class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <div class="contact-header">
        <?php if ( !empty( $bk_cf_top['id'] ) ) : ?>
            <div class="contact-header__image">
                <?php  echo wp_get_attachment_image( $bk_cf_top['id'], 'large' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( !empty( $cf_top ) ) : ?>
            <div class="contact-header__form">
                <?php echo do_shortcode( '[contact-form-7 id="' . $cf_top . '" ]' ); ?>
            </div>
        <?php endif; ?>
    </div>
</header>