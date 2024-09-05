<?php
$slogan = clinic_get_option( 'opt_general_slogan' );
$banner_mobile = clinic_get_option( 'opt_general_banner_mobile' );
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
?>
<header class="header-warp">
    <div class="container">
        <?php if ( $slogan ) : ?>
            <div class="slogan">
                <?php echo esc_html( $slogan ) ?>
            </div>
        <?php endif; ?>

        <?php if ( $banner_mobile['id'] ) : ?>
            <div class="banner-mobile">
                <?php echo wp_get_attachment_image( $banner_mobile['id'], 'full' ); ?>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <?php
    get_template_part('components/header/inc','top-nav');

    get_template_part('components/header/inc','top-nav-mobile');
//
//    get_template_part('components/header/inc','contact-mobile');
    ?>
</div>