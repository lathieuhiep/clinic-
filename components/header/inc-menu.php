<nav class="navbar-main d-none d-lg-block">
    <div class="container">
        <div id="primary-menu" class="navbar-main__menu collapse navbar-collapse d-lg-block">
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
    </div>
</nav>