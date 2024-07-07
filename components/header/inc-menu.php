<?php
$link_chat = clinic_get_opt_link_chat_doctor();
?>

<nav class="navbar-main d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
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

            <?php if ( $link_chat ) : ?>
                <div class="chat-box">
                    <a class="chat-box__btn" href="<?php echo esc_url( $link_chat  ); ?>" target="_blank">
                        <i class="icon-chat"></i>
                        <span class="text-uppercase"><?php esc_html_e('Chat với bác sĩ', 'clinic'); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>