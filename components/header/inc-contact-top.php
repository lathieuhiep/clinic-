<?php
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
$hotline = clinic_get_opt_hotline();
?>

<header class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <a class="link-tel" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ) ?>"></a>

    <div class="container">
        <div class="contact-header">
            <div class="contact-header__phone">
                <div class="left-box">
                    <i class="icon-phone-light alo-circle-anim d-inline-block"></i>
                    <span class="txt"><?php esc_html_e('Hotline', 'clinic'); ?></span>
                </div>

                <div class="right-box">
                    <strong class="hotline"><?php echo esc_html( $hotline ); ?></strong>
                </div>
            </div>

            <div class="contact-header__btn">
                <p class="txt">
                    <?php esc_html_e('Bác sĩ tư vấn', 'clinic'); ?>
                </p>
            </div>
        </div>
    </div>
</header>