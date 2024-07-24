<?php
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$address = clinic_get_opt_general_address();
$link_chat = clinic_get_opt_link_chat_doctor();
?>

<div class="contact-info">
    <div class="grid">
        <div class="item item-address">
            <div class="item__top">
                <i class="icon-location"></i>
            </div>

            <div class="item__body">
                <span class="txt"><?php esc_html_e('Địa chỉ', 'clinic'); ?></span>

                <span class="value"><?php echo esc_html( $address ); ?></span>
            </div>
        </div>

        <div class="item item-hotline">
            <div class="item__top">
                <i class="icon-phone-light alo-circle-anim d-inline-block"></i>
            </div>

            <div class="item__body">
                <span class="txt"><?php esc_html_e('Hotline tư vấn:', 'clinic'); ?></span>

                <a class="phone fw-bold" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                    <?php echo esc_html( $hotline ); ?>
                </a>
            </div>
        </div>
    </div>
</div>