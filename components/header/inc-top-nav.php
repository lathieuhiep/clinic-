<?php
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$address = clinic_get_opt_general_address();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
            <div class="logo d-flex align-items-center">
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

            <div id="primary-menu" class="primary-menu">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class' => 'd-lg-flex reset-list',
                        'container' => false,
                    ) );
                else:
                    ?>
                    <ul class="main-menu">
                        <li>
                            <a href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
                                <?php esc_html_e( 'ADD TO MENU', 'clinic' ); ?>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="search-warp d-flex align-items-center">
                <button type="button" class="btn btn-search" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="icon-search"></i>
                </button>
            </div>

            <?php if ( $hotline ) : ?>
                <div class="hotline-warp d-flex align-items-center">
                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                        <i class="icon-phone-light d-inline-block alo-circle-anim"></i>
                        <span class="tel"><?php echo esc_html( $hotline ) ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>