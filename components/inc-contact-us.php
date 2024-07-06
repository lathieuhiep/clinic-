<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$chat_messenger = clinic_get_opt_link_chat_messenger();
$link_chat = clinic_get_opt_link_chat_doctor();
?>

<div class="contact-us-group d-none d-lg-block">
    <div class="container">
        <div class="grid-layout text-uppercase">
            <?php if ( $phone ) : ?>
                <div class="item phone">
                    <a class="link" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>"></a>

                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/goi-dien.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <span class="txt-top"><?php esc_html_e('BÁC SĨ TƯ VẤN', 'clinic'); ?></span>
                        <span class="txt-sub"><?php echo esc_html( $phone ) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $chat_messenger ) : ?>
                <div class="item chat">
                    <a class="link" href="<?php echo esc_url( $chat_messenger ); ?>" target="_blank"></a>

                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/tro-chuyen.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <span class="txt-top"><?php esc_html_e('TƯ VẤN', 'clinic'); ?></span>
                        <span class="txt-sub"><?php esc_html_e('CHAT CÙNG BÁC SĨ', 'clinic'); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $link_chat ) : ?>
                <div class="item chat">
                    <a class="link" href="<?php echo esc_url( $link_chat ); ?>" target="_blank"></a>

                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/tro-chuyen.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <span class="txt-top"><?php esc_html_e('TƯ VẤN', 'clinic'); ?></span>
                        <span class="txt-sub"><?php esc_html_e('CHAT CÙNG BÁC SĨ', 'clinic'); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $medical_appointment_form ) :?>
                <div class="item booking">
                    <a class="link" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form"></a>

                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/dat-lich.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <span class="txt-top"><?php esc_html_e('ĐĂNG KÝ KHÁM', 'clinic'); ?></span>
                        <span class="txt-sub"><?php esc_html_e('ĐẶT LỊCH HẸN KHÁM', 'clinic'); ?></span>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php if ( $medical_appointment_form ) : ?>

<!-- Modal medical appointment -->
<div class="modal fade modal-appointment-form" id="modal-appointment-form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <?php esc_html_e('Đặt hẹn khám', 'clinic'); ?>
                </h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <?php echo do_shortcode('[contact-form-7 id="' . $medical_appointment_form . '" ]'); ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>