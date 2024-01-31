<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$link_chat = clinic_get_opt_link_chat_doctor();
$link_messenger = clinic_get_opt_link_chat_messenger();
?>

<div class="contact-us-mobile d-lg-none">
    <div class="contact-us-mobile__grid">
        <?php if ( $phone ) : ?>
        <div class="item">
            <a href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
                <span class="txt"><?php echo esc_html($phone); ?></span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ( $link_messenger ) : ?>
            <div class="item">
                <a href="<?php echo esc_url( $link_messenger ); ?>" target="_blank">
                    <span class="txt"><?php esc_html_e('Messenger', 'clinic'); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if ( $medical_appointment_form ) : ?>
            <div class="item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                    <span class="txt"><?php esc_html_e('Đặt lịch', 'clinic'); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>