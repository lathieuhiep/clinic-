<?php
$banner_top = clinic_get_option( 'opt_general_banner_top' );
$logo_mobile = clinic_get_option( 'opt_general_logo_mobile' );
$hotline = clinic_get_opt_hotline();
?>
<div class="top-nav-mobile d-lg-none">
    <div class="container h-100">
        <?php if ( $banner_top ) : ?>
        <div class="banner-top">
            <?php echo wp_get_attachment_image( $banner_top['id'], 'full' ); ?>
        </div>
        <?php endif; ?>

        <div class="grid-warp h-100">
            <div class="item hamburger">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 26 20" fill="none">
                        <path d="M25.0714 17.1429H0.928571C0.682299 17.1429 0.446113 17.2181 0.271972 17.3521C0.0978314 17.486 0 17.6677 0 17.8571L0 19.2857C0 19.4752 0.0978314 19.6568 0.271972 19.7908C0.446113 19.9247 0.682299 20 0.928571 20H25.0714C25.3177 20 25.5539 19.9247 25.728 19.7908C25.9022 19.6568 26 19.4752 26 19.2857V17.8571C26 17.6677 25.9022 17.486 25.728 17.3521C25.5539 17.2181 25.3177 17.1429 25.0714 17.1429ZM25.0714 11.4286H0.928571C0.682299 11.4286 0.446113 11.5038 0.271972 11.6378C0.0978314 11.7717 0 11.9534 0 12.1429L0 13.5714C0 13.7609 0.0978314 13.9426 0.271972 14.0765C0.446113 14.2105 0.682299 14.2857 0.928571 14.2857H25.0714C25.3177 14.2857 25.5539 14.2105 25.728 14.0765C25.9022 13.9426 26 13.7609 26 13.5714V12.1429C26 11.9534 25.9022 11.7717 25.728 11.6378C25.5539 11.5038 25.3177 11.4286 25.0714 11.4286ZM25.0714 5.71429H0.928571C0.682299 5.71429 0.446113 5.78954 0.271972 5.9235C0.0978314 6.05745 0 6.23913 0 6.42857L0 7.85714C0 8.04658 0.0978314 8.22826 0.271972 8.36222C0.446113 8.49617 0.682299 8.57143 0.928571 8.57143H25.0714C25.3177 8.57143 25.5539 8.49617 25.728 8.36222C25.9022 8.22826 26 8.04658 26 7.85714V6.42857C26 6.23913 25.9022 6.05745 25.728 5.9235C25.5539 5.78954 25.3177 5.71429 25.0714 5.71429ZM25.0714 0H0.928571C0.682299 0 0.446113 0.0752549 0.271972 0.209209C0.0978314 0.343164 0 0.524845 0 0.714286L0 2.14286C0 2.3323 0.0978314 2.51398 0.271972 2.64793C0.446113 2.78189 0.682299 2.85714 0.928571 2.85714H25.0714C25.3177 2.85714 25.5539 2.78189 25.728 2.64793C25.9022 2.51398 26 2.3323 26 2.14286V0.714286C26 0.524845 25.9022 0.343164 25.728 0.209209C25.5539 0.0752549 25.3177 0 25.0714 0Z" fill="#0B7158"/>
                    </svg>
                </button>
            </div>

            <div class="item logo text-center">
                <a class="logo__image" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo_mobile['id'] ) ) :
                        echo wp_get_attachment_image( $logo_mobile['id'], 'full' );
                    else :
                    ?>

                        <img class="logo-default"
                             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>
            </div>

            <?php if ( $hotline ) : ?>
                <div class="item contact">
                    <a href="tel:<?php echo esc_attr( clinic_preg_replace_ony_number($hotline) ); ?>">
                        <svg class="icon alo-circle-anim" xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.35888 0.205162L3.24417 0.0281045C3.85929 -0.0949189 4.4834 0.193694 4.78804 0.742052L6.29826 3.46046C6.61104 4.02346 6.5127 4.72559 6.05729 5.181L5.04056 6.19773C4.5726 6.66625 4.48374 7.39321 4.82549 7.9604C5.399 8.91392 6.0666 9.77154 6.8283 10.5332C7.59001 11.2949 8.44701 11.9619 9.39933 12.5342C9.9666 12.8745 10.6926 12.7852 11.1606 12.3177L12.1773 11.301C12.6327 10.8456 13.3348 10.7473 13.8978 11.06L16.6162 12.5703C17.1646 12.8749 17.4532 13.499 17.3302 14.1141L17.1531 14.9994C17.0685 15.4222 16.7992 15.785 16.4184 15.9872C12.8454 17.8917 8.9682 16.7531 4.78668 12.5716C0.605155 8.3901 -0.533362 4.51287 1.37113 0.93995C1.5733 0.559101 1.93609 0.289794 2.35888 0.205162Z" fill="#04916F"/>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>