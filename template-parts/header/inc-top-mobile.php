<?php
$logo_mobile = clinic_get_option( 'opt_general_logo_mobile' );
$hotline = clinic_get_opt_hotline();
?>
<div class="top-mobile">
    <div class="container h-100">
        <div class="grid-warp h-100">
            <div class="item hamburger">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="icon-menu"></i>
                </button>
            </div>

            <div class="item logo text-center">
                <a class="logo__image" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo_mobile['id'] ) ) :
                        echo wp_get_attachment_image( $logo_mobile['id'], 'medium_large' );
                    else :
                    ?>
                        <img class="logo-default"
                             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>
                    <?php endif; ?>
                </a>
            </div>

            <?php if ( $hotline ) : ?>
                <div class="item contact">
                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ); ?>">
                        <i class="icon icon-phone-light alo-circle-anim"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>