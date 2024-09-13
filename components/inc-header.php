<?php
$sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$chat_zalo = clinic_get_opt_chat_zalo();

if( !empty( $chat_zalo ) ) {
    $zalo_select = $chat_zalo['select_zalo'];
    $zalo_phone = $chat_zalo['phone'];
    
    if ( $zalo_select == 'phone_qr' ) :
        $zalo_class = ' chat-with-us__zalo';
        $target = '_self';
        $zalo_qr_code = $chat_zalo['qr_code'];
        $zalo_link = 'https://zalo.me/' . clinic_preg_replace_ony_number($zalo_phone);
    else:
        $zalo_class = '';
        $target = '_blank';
        $zalo_qr_code = '';
        $zalo_link = $chat_zalo['link'];
    endif;
}
?>

<header class="header-warp d-none d-lg-block">
    <div class="container">
        <div class="grid">
            <div class="logo">
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

            <div class="info">
                <div class="item">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/info/info-work-time.webp' ) ) ?>" alt=""/>
                    </div>

                    <div class="item__content">
                        <span class="txt"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></span>

                        <strong class="value time"><?php echo esc_html( $working_time ); ?></strong>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/info/info-hotline.webp' ) ) ?>" alt=""/>
                    </div>

                    <div class="item__content">
                        <span class="txt"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></span>

                        <a class="phone fw-bold value" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                            <?php echo esc_html( $hotline ); ?>
                        </a>
                    </div>
                </div>

                <?php if ( !empty( $chat_zalo ) ) : ?>
                    <div class="item">
                        <div class="item__icon">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/info/info-zalo.webp' ) ) ?>" alt=""/>
                        </div>

                        <div class="item__content">
                            <span class="txt"><?php esc_html_e('Click tư vấn', 'clinic'); ?></span>

                            <a class="phone fw-bold value<?php echo esc_attr( $zalo_class ); ?>" href="<?php echo esc_url( $zalo_link ) ?>" data-phone="<?php echo esc_attr( $zalo_phone ); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>" target="<?php echo esc_attr( $target ); ?>">
                                <?php echo esc_html( $zalo_phone ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<div class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <?php
    get_template_part('components/header/inc','top-nav-mobile');

    get_template_part('components/header/inc','menu');

    get_template_part('components/header/inc','contact-mobile');
    ?>
</div>