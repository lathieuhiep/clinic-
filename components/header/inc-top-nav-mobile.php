<?php
$hotline = clinic_get_opt_hotline();
$working_time = clinic_get_option('opt_general_working_time');
?>
<div class="top-nav-mobile d-lg-none">
    <div class="container">
        <div class="grid-warp">
            <div class="hamburger">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="icon-menu"></i>
                </button>
            </div>

            <div class="info">
                <?php if ( $hotline ) : ?>
                    <div class="info__item">
                        <div class="left-box">
                            <i class="icon-phone-light d-inline-block alo-circle-anim"></i>
                        </div>

                        <div class="right-box">
                            <a class="option-val" href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ); ?>">
                                <span class="txt"><?php esc_html_e('Hotline tư vấn', 'clinic'); ?></span>
                                <span class="value phone"><?php echo esc_html( $hotline ); ?></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $working_time ) : ?>
                    <div class="info__item">
                        <div class="left-box">
                            <i class="icon-clock"></i>
                        </div>

                        <div class="right-box">
                            <p class="option-val">
                                <span class="txt"><?php esc_html_e('Thời gian làm việc', 'clinic'); ?></span>
                                <span class="value"><?php echo esc_html( $working_time ); ?></span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="search-warp">
                <button type="button" class="btn btn-search" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="icon-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>