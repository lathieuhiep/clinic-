<nav class="navbar-main">
    <div class="container">
        <div id="primary-menu" class="primary-menu">
            <?php
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class' => 'd-flex justify-content-around reset-list',
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