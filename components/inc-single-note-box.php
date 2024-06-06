<?php
$phone = clinic_get_opt_hotline();
$medical_appointment_form = clinic_get_opt_medical_appointment();
$link_chat = clinic_get_opt_link_chat_doctor();
$link_map = clinic_get_opt_link_map();
?>

<div class="single-note-box">
    <div class="box-image">
        <div class="thumbnail-image">
            <img src="<?php echo esc_url( get_theme_file_uri('assets/images/luu-y/ho-tro-khach-hang.png') ) ?>" alt="">
        </div>
    </div>

    <div class="box-content">
        <h4 class="heading">
            <?php esc_html_e('Nếu bạn chưa có thời gian đi khám thì có thể khám online với bác sĩ chuyên khoa bằng cách:', 'clinic'); ?>
        </h4>

        <div class="list">
            <?php if ( $phone ) : ?>
                <div class="item item-hotline">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('assets/images/luu-y/dien-thoai.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <p>
                            <?php esc_html_e('Gọi điện trực tiếp tới SĐT của bác sĩ:'); ?>
                            <a href="tel:<?php echo clinic_preg_replace_ony_number( $phone ); ?>"><?php echo esc_html( $phone ) ?></a>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $link_chat ) : ?>
                <div class="item item-chat">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('assets/images/luu-y/click-chat.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <p>
                            <?php esc_html_e('Click', 'clinic'); ?>
                            <a href="<?php echo esc_html( $link_chat ) ?>">
                                [<?php esc_html_e('KHÁM ONLINE MIỄN PHÍ', 'clinic'); ?>]
                            </a>
                            <?php esc_html_e( 'để trao đổi trực tiếp với bác sĩ', 'clinic' ) ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $medical_appointment_form ) : ?>
                <div class="item item-chat item-appointment">
                    <div class="item__icon">
                        <img src="<?php echo esc_url( get_theme_file_uri('assets/images/luu-y/tiet-kiem.png') ) ?>" alt="">
                    </div>

                    <div class="item__content">
                        <p>
                            <?php esc_html_e('Để tiết kiệm chi phí, bạn có thể', 'clinic'); ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                [<?php esc_html_e('để lại số điện thoại', 'clinic'); ?>]
                            </a>
                            <?php esc_html_e( 'chúng tôi sẽ liên hệ lại', 'clinic' ) ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>