<?php
$medical_appointment_form = clinic_get_opt_medical_appointment();

if ( $medical_appointment_form ) :
?>
    <div class="book d-flex align-items-center">
        <a class="link d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
            <span class="txt"><?php esc_html_e('Đặt hẹn khám', 'clinic'); ?></span>
            <i class="icon-arrow-right"></i>
        </a>
    </div>
<?php endif; ?>