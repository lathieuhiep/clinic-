<?php
$address = clinic_get_option('opt_general_address');
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="top-nav__info">
            <div class="item">
                <i class="icon-location"></i>

                <p class="item__txt">
                    <span><?php esc_html_e('Địa chỉ:', 'clinic'); ?></span>
                    <span><?php echo esc_html( $address ); ?></span>
                </p>
            </div>

            <div class="item">
                <i class="icon-clock"></i>

                <p class="item__txt">
                    <span><?php esc_html_e('Thời gian làm việc:', 'clinic'); ?></span>
                    <span><?php echo esc_html( $working_time ); ?></span>
                </p>
            </div>

            <div class="item group-phone">
                <i class="icon-phone-circle"></i>

                <p class="item__txt">
                    <span><?php esc_html_e('Hotline tư vấn:', 'clinic'); ?></span>

                    <a class="animate-character" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                        <?php echo esc_html( $hotline ); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>