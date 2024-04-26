<?php
$logo = clinic_get_option( 'opt_general_logo' );
$working_time = clinic_get_option('opt_general_working_time');
$hotline = clinic_get_option('opt_general_hotline');
?>

<div class="top-nav d-none d-lg-block">
    <div class="container">
        <div class="navbar-top-grid">
            <div class="logo">
                <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'full' );
                    else :
                        ?>

                        <img class="logo-default"
                             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>
            </div>

            <div class="info">
                <div class="info__item work-time">
                    <div class="left-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                            <circle cx="18" cy="18" r="13" stroke="white" stroke-width="2"/>
                            <path d="M24.75 18H18.25C18.1119 18 18 17.8881 18 17.75V12.75" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <div class="right-box">
                        <p class="heading m-0">
                            <?php esc_html_e('GIỜ LÀM VIỆC', 'clinic'); ?>
                        </p>

                        <strong class="txt"><?php echo esc_html($working_time); ?></strong>
                    </div>
                </div>

                <?php if ( $hotline ) : ?>
                    <div class="info__item phone">
                        <div class="left-box">
                            <svg class="alo-circle-anim" xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.33481 4.25456L7.43326 4.03487C8.19649 3.88223 8.97088 4.24033 9.34888 4.92073L11.2227 8.2937C11.6108 8.99226 11.4888 9.86346 10.9238 10.4285L9.6622 11.6901C9.08157 12.2714 8.97131 13.1734 9.39534 13.8772C10.1069 15.0603 10.9353 16.1244 11.8804 17.0695C12.8255 18.0146 13.8889 18.8423 15.0705 19.5524C15.7744 19.9745 16.6752 19.8638 17.2558 19.2837L18.5174 18.0222C19.0825 17.4571 19.9537 17.3351 20.6522 17.7232L24.0252 19.597C24.7056 19.975 25.0637 20.7494 24.9111 21.5127L24.6914 22.6111C24.5864 23.1357 24.2522 23.5859 23.7796 23.8367C19.3464 26.1998 14.5356 24.7871 9.34719 19.5987C4.1588 14.4103 2.74614 9.59953 5.10921 5.16628C5.36007 4.69373 5.81021 4.35957 6.33481 4.25456Z" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div class="right-box">
                            <p class="heading m-0">
                                <?php esc_html_e('HOTLINE', 'clinic'); ?>
                            </p>

                            <div class="phone-list">
                                <?php
                                foreach ( $hotline as $item ) :
                                    $phone = clinic_preg_replace_ony_number($item['phone']);
                                    ?>
                                    <a href="tel:<?php echo esc_attr($phone); ?>" class="fw-bold txt item-phone">
                                        <?php echo esc_html($item['phone']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>