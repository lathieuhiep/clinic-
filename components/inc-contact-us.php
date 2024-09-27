<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$link_chat_doctor = clinic_get_opt_link_chat_doctor();
$link_chat_messenger = clinic_get_opt_link_chat_messenger();
?>

<div class="contact-us-group">
    <div class="container">
        <div class="grid-layout text-uppercase">
            <?php if ( $phone ) : ?>
                <div class="item phone">
                    <a class="link" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>"></a>

                    <div class="item__icon">
                        <i class="icon-phone-circle"></i>
                    </div>

                    <div class="item__content">
                        <?php esc_html_e('Hotline', 'clinic'); ?>: <?php echo esc_html($phone); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $medical_appointment_form ) :?>
                <div class="item booking">
                    <a class="link" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form"></a>

                    <div class="item__icon">
                        <i class="icon-calendar"></i>
                    </div>

                    <div class="item__content">
                        <?php esc_html_e('Đặt hẹn khám bệnh', 'clinic'); ?>
                    </div>
                </div>
            <?php endif;?>

            <?php if ( $link_chat_doctor ) : ?>
                <div class="item chat">
                    <a class="link" href="<?php echo esc_url( $link_chat_doctor ); ?>" target="_blank"></a>

                    <div class="item__icon">
                        <i class="icon-chat-light"></i>
                    </div>

                    <div class="item__content">
                        <?php esc_html_e('Chat với bác sĩ', 'clinic'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $link_chat_messenger ) : ?>
                <div class="item chat">
                    <a class="link" href="<?php echo esc_url( $link_chat_messenger ); ?>" target="_blank"></a>

                    <div class="item__icon">
                        <i class="icon-facebook-messenger"></i>
                    </div>

                    <div class="item__content">
                        <?php esc_html_e('Chat messenger', 'clinic'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>