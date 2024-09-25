<?php
$hotline = clinic_get_opt_hotline();
$address = clinic_get_opt_general_address();
$chat_zalo = clinic_get_chat_zalo();
$working_time = clinic_get_option('opt_general_working_time');
?>

<div class="info">
    <!-- hotline -->
    <div class="item">
        <div class="item__icon">
            <i class="icon-phone-light alo-circle-anim d-inline-block"></i>
        </div>

        <div class="item__content">
            <span class="txt"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></span>

            <?php if ( $hotline ) : ?>
                <a class="phone value" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                    <?php echo esc_html( $hotline ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- address -->
    <div class="item">
        <div class="item__icon">
            <i class="icon-location"></i>
        </div>

        <div class="item__content">
            <span class="txt"><?php esc_html_e('Địa chỉ', 'clinic'); ?></span>

            <?php if ( !empty( $address ) ) : ?>
                <span class="value time"><?php echo esc_html( $address ); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <!-- working_time -->
    <div class="item">
        <div class="item__icon">
            <i class="icon-clock"></i>
        </div>

        <div class="item__content">
            <span class="txt"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></span>

            <?php if ( $hotline ) : ?>
                <span class="value time"><?php echo esc_html( $working_time ); ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>