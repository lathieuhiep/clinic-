<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$link_chat = clinic_get_opt_link_chat_doctor();
$link_map = clinic_get_opt_link_map();
?>

<div class="contact-us-group d-none d-lg-block">
    <div class="container">
        <div class="grid-layout text-uppercase">
	        <?php if ( $phone ) : ?>
                <div class="item phone">
                    <div class="item__content">
                        <a href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/goi-dien.png') ) ?>" alt="">
                        </a>
                    </div>
                </div>
	        <?php endif; ?>

            <?php if ( $link_chat ) : ?>
                <div class="item chat">
                    <div class="item__content">
                        <a href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/tro-chuyen.png') ) ?>" alt="">
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $medical_appointment_form ) :?>
                <div class="item booking">
                    <div class="item__content">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/dat-lich.png') ) ?>" alt="">
                        </a>
                    </div>
                </div>
            <?php endif;?>

            <?php if ( $link_map ) : ?>
                <div class="item chat">
                    <div class="item__content">
                        <a href="<?php echo esc_url( $link_map ); ?>" target="_blank">
                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/ho-tro/dia-chi.png') ) ?>" alt="">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
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