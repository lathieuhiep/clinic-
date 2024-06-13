<?php
$logo = clinic_get_option( 'opt_general_logo' );
$logo_mobile = clinic_get_option( 'opt_general_logo_mobile' );

$address = clinic_get_opt_general_address();
?>

<div class="logo-header">
    <div class="container">
        <div class="grid">
            <div class="item image-box">
                <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'medium_large', '', array( 'class' => 'logo-pc' ) );
                        echo wp_get_attachment_image( $logo_mobile['id'], 'medium', '', array( 'class' => 'logo-mobile' ) );
                    else :
                        ?>
                        <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>
                    <?php endif; ?>
                </a>
            </div>

            <div class="item">
                <div class="address-box">
                    <i class="icon icon-location"></i>

                    <span><?php echo esc_html( $address ); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>