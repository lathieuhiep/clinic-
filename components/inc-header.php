<?php
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$address = clinic_get_opt_general_address();
?>
<header class="header-warp">
    <div class="container">
        <div class="grid">
            <div class="work-time">
                <div class="item__icon">
                    <i class="icon-clock"></i>
                </div>

                <div class="item__content">
                    <p class="txt"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></p>

                    <strong class="value"><?php echo esc_html( $working_time ); ?></strong>
                </div>
            </div>

<!--            <div class="logo">-->
<!--                <a class="d-block" href="--><?php //echo esc_url( get_home_url( '/' ) ); ?><!--" title="--><?php //bloginfo( 'name' ); ?><!--">-->
<!--                    --><?php
//                    if ( ! empty( $logo['id'] ) ) :
//                        echo wp_get_attachment_image( $logo['id'], 'full' );
//                    else :
//                        ?>
<!---->
<!--                        <img class="logo-default" src="--><?php //echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?><!--" alt="--><?php //echo esc_attr( get_bloginfo( 'title' ) ); ?><!--" width="64" height="64"/>-->
<!---->
<!--                    --><?php //endif; ?>
<!--                </a>-->
<!--            </div>-->

            <div class="notch-container">
                <div class="notch"></div>
            </div>

            <div class="info">
                <div class="item">
                    <div class="item__icon">
                        <i class="icon-phone-light"></i>
                    </div>

                    <div class="item__content">
                        <p class="txt"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></p>

                        <a class="phone fw-bold value" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                            <?php echo esc_html( $hotline ); ?>
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <i class="icon-location"></i>
                    </div>

                    <div class="item__content">
                        <p class="txt"><?php esc_html_e('Địa chỉ', 'clinic'); ?></p>

                        <strong class="value"><?php echo esc_html( $address ); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <?php
//    get_template_part('components/header/inc','top-nav');

    get_template_part('components/header/inc','top-nav-mobile');

    get_template_part('components/header/inc','menu');

    get_template_part('components/header/inc','contact-mobile');
    ?>
</div>