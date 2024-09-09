<?php


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
                        <p class="txt"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></p>

                        <a class="phone fw-bold value" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number( $hotline ) ); ?>">
                            <?php echo esc_html( $hotline ); ?>
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="item__icon">
                        <i class="icon-clock"></i>
                    </div>

                    <div class="item__content">
                        <p class="txt"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></p>

                        <strong class="value"><?php echo esc_html( $working_time ); ?></strong>
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
</div>