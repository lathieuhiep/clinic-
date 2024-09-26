<?php
$hotline = clinic_get_opt_hotline();
$chat_zalo = clinic_get_chat_zalo();
$working_time = clinic_get_option('opt_general_working_time');
?>

<div class="info">
    <!-- hotline -->
    <div class="item">
        <div class="item__icon alo-circle-anim">
            <i class="icon-phone-light"></i>
        </div>

        <div class="item__content">
            <p class="desc"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></p>

            <a class="txt phone" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                <?php echo esc_html( $hotline ); ?>
            </a>
        </div>
    </div>

    <!-- zalo -->
    <div class="item item-zalo">
        <div class="item__icon">
            <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-logo.png' ) ) ?>" />
        </div>

        <div class="item__content">
            <p class="desc"><?php esc_html_e('Click tư vấn', 'clinic'); ?></p>

            <?php if ( !empty( $chat_zalo['phone'] ) ) : ?>
                <a class="txt zalo<?php echo esc_attr( $chat_zalo['class'] ); ?>"
                   href="<?php echo esc_url( $chat_zalo['link'] ) ?>"
                   data-phone="<?php echo esc_attr( clinic_preg_replace_ony_number( $chat_zalo['phone'] ) ); ?>"
                   data-qr-code="<?php echo esc_attr( $chat_zalo['qr_code'] ); ?>"
                   target="<?php echo esc_attr( $chat_zalo['target'] ); ?>"
                >
                    <?php esc_html_e( 'Qua zalo', 'clinic' ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- working_time -->
    <div class="item">
        <div class="item__icon">
            <i class="icon-clock"></i>
        </div>

        <div class="item__content">
            <p class="desc"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></p>

            <p class="txt time"><?php echo esc_html( $working_time ); ?></p>
        </div>
    </div>
</div>