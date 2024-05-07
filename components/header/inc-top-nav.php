<?php
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$licensing = clinic_get_opt_general_licensing();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
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
                <?php if ( !empty( $licensing['id'] ) ) : ?>
                    <div class="item-licensing d-flex align-items-center">
                        <?php echo wp_get_attachment_image( $licensing['id'], 'medium' ); ?>
                    </div>
                <?php endif; ?>

                <div class="item-hotline">
                    <div class="item-hotline__box">
                        <div class="left-box">
                            <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/image-hotline.png' ) ) ?>" alt="" width="33" height="39"/>
                        </div>

                        <div class="right-box">
                            <p class="txt text-uppercase">
                                <?php esc_html_e( 'số hotline tư vấn miễn phí', 'clinic' ); ?>
                            </p>

                            <a class="phone fw-bold" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                                <?php echo esc_html( $hotline ); ?>
                            </a>
                        </div>
                    </div>

                    <div class="item-hotline__note text-uppercase">
                        <?php esc_html_e('Làm việc tất cả các ngày trong tuần', 'clinic'); ?>
                    </div>
                </div>

                <div class="item d-flex align-items-center">
                    <div class="item__icon">
                        <i class="icon-clock"></i>
                    </div>

                    <div class="item__content">
                        <p><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></p>

                        <strong><?php echo esc_html( $working_time ); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>