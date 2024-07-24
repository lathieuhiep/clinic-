<?php
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
?>

<nav class="navbar-main d-none d-lg-block <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <div class="container">
        <div class="grid-layout">
            <div id="primary-menu" class="primary-menu">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class' => 'd-lg-flex reset-list justify-content-around',
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

            <div class="search-box d-flex align-items-center">
                <?php get_search_form() ?>
            </div>
        </div>
    </div>
</nav>