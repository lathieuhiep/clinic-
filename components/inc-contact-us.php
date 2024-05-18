<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$chat_zalo = clinic_get_opt_chat_zalo();
$link_chat_messenger = clinic_get_opt_link_chat_messenger();
?>

<div class="contact-us-group">
    <div class="container">
        <div class="grid-layout">
            <?php if ( $link_chat_messenger ) : ?>
                <div class="item">
                    <div class="item__box messenger">
                        <a class="link" href="<?php echo esc_url( $link_chat_messenger ); ?>" target="_blank">
                            <span class="content text-uppercase"><?php esc_html_e('Nhận tư vấn qua messenger', 'clinic'); ?></span>

                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-contact/messenger.png') ) ?>" alt="<?php esc_attr_e('messenger', 'clinic'); ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $medical_appointment_form ) : ?>
                <div class="item">
                    <div class="item__box booking">
                        <a class="link" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                            <span class="content text-uppercase"><?php esc_html_e('Đặt lịch hẹn khám trước', 'clinic'); ?></span>

                            <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-contact/calender.png') ) ?>" alt="<?php esc_attr_e('đặt lịch', 'clinic'); ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>

	        <?php if ( $phone ) : ?>
                <div class="item">
                    <div class="item__box phone">
                        <a class="link" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($phone)); ?>">
                            <span class="txt text-uppercase">
                                <?php esc_html_e('Liên hệ ngay qua hotline', 'clinic'); ?>
                            </span>

                            <span class="content"><?php echo esc_html($phone); ?></span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            if ( $chat_zalo ) :
                $zalo_selcet = $chat_zalo['select_zalo'];
            ?>
                <div class="item">
                    <div class="item__box zalo">
                        <?php
                        if ( $zalo_selcet == 'phone_qr' ) :
                            $zalo_phone = $chat_zalo['phone'];
                            $zalo_qr_code = $chat_zalo['qr_code'];
                        ?>
                            <a class="link chat-zalo" href="https://zalo.me/<?php echo esc_attr( clinic_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
                                <span class="content text-uppercase"><?php esc_html_e( 'Nhận tư vấn qua', 'clinic' ); ?></span>

                                <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-contact/zalo.png') ) ?>" alt="">
                            </a>
                        <?php else: ?>
                            <a class="link" href="<?php echo esc_url( $chat_zalo['link'] ); ?>" target="_blank">
                                <span class="content text-uppercase"><?php esc_html_e( 'Nhận tư vấn qua', 'clinic' ); ?></span>

                                <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-contact/zalo.png') ) ?>" alt="">
                            </a>
                        <?php endif; ?>
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