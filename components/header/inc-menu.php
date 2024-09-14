<?php $medical_appointment_form = clinic_get_opt_medical_appointment(); ?>

<nav class="navbar-main d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
            <?php get_template_part('components/inc','logo-main'); ?>

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

            <?php if ( $medical_appointment_form ) :?>
            <div class="book d-flex align-items-center">
                <a class="link d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                    <span class="txt"><?php esc_html_e('Đặt hẹn khám', 'clinic'); ?></span>
                    <i class="icon-arrow-right"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>