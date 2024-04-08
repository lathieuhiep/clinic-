<?php
$logo = clinic_get_option( 'opt_general_logo' );
$address = clinic_get_opt_general_address();
$hotline = clinic_get_opt_hotline();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
            <div class="logo">
                <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'full' );
                    else :
                        ?>

                        <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>
            </div>

            <div class="info">
                <div class="item">
                    <div class="item__icon">
                        <i class="icon-phone-light"></i>
                    </div>

                    <div class="item__content">
                        <p><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></p>

                        <a class="phone fw-bold" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                            <?php echo esc_html( $hotline ); ?>
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <i class="icon-location"></i>
                    </div>

                    <div class="item__content">
                        <?php if ( !empty( $address ) ) : ?>
                            <p><?php esc_html_e('Địa chỉ', 'clinic'); ?></p>

                            <strong class="text-uppercase"><?php echo esc_html( $address ); ?></strong>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>