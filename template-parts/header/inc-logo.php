<?php $logo = clinic_get_option( 'opt_general_logo' ); ?>

<div class="logo d-flex align-items-center">
    <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
        <?php
        if ( ! empty( $logo['id'] ) ) :
            echo wp_get_attachment_image( $logo['id'], 'medium_large' );
        else :
            ?>

            <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

        <?php endif; ?>
    </a>
</div>