<?php
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_opt_hotline();
$address = clinic_get_opt_general_address();
$link_chat = clinic_get_opt_link_chat_doctor();
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="grid-layout">
            <div class="info">
                <div class="item">
                    <div class="item__icon alo-circle-anim">
                        <i class="icon-phone-light"></i>
                    </div>

                    <div class="item__content">
                        <span class="txt"><?php esc_html_e('Hotline tư vấn:', 'clinic'); ?></span>

                        <a class="phone" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                            <?php echo esc_html( $hotline ); ?>
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <i class="icon-clock"></i>
                    </div>

                    <div class="item__content">
                        <span class="txt"><?php esc_html_e('Thời gian làm việc:', 'clinic'); ?></span>

                        <span class="value"><?php echo esc_html( $working_time ); ?></span>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <i class="icon-location"></i>
                    </div>

                    <div class="item__content">
                        <span class="txt"><?php esc_html_e('Địa chỉ:', 'clinic'); ?></span>

                        <span class="value"><?php echo esc_html( $address ); ?></span>
                    </div>
                </div>
            </div>

            <div class="chat">
                <?php if ( $link_chat ) : ?>
                    <a class="link f-family-heading fw-bold" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                        <?php esc_html_e('Chat với bác sĩ', 'clinic'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>