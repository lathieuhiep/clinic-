<?php
// get hotline theme option general
function clinic_get_opt_hotline()
{
    return clinic_get_option('opt_general_hotline_mobile');
}

// get medical appointment theme option general
function clinic_get_opt_medical_appointment()
{
    return clinic_get_option('opt_general_medical_appointment_form');
}

// get link chat doctor theme option general
function clinic_get_opt_link_chat_doctor()
{
    return clinic_get_option('opt_general_chat_doctor');
}

// get link chat messenger theme option general
function clinic_get_opt_link_chat_messenger()
{
    return clinic_get_option('opt_general_chat_messenger');
}

// get chat zalo theme option general
function clinic_get_opt_chat_zalo()
{
    return clinic_get_option('opt_general_chat_zalo');
}

// get chat zalo
function clinic_get_chat_zalo(): array
{
    $chat_zalo = clinic_get_opt_chat_zalo();

    $zalo = array(
        'class' => '',
        'target' => '_self',
        'phone' => '',
        'qr_code' => '',
        'link' => ''
    );

    if( !empty( $chat_zalo ) ) {
        $zalo_select = $chat_zalo['select_zalo'];
        $zalo['phone'] = $chat_zalo['phone'];

        if ( $zalo_select == 'phone_qr' ) :
            $zalo['class'] = ' chat-with-us__zalo';
            $zalo['qr_code'] = $chat_zalo['qr_code'];
            $zalo['link'] = 'https://zalo.me/' . clinic_preg_replace_ony_number( $zalo['phone'] );
        else:
            $zalo['target'] = '_blank';
            $zalo['link'] = $chat_zalo['link'];
        endif;
    }

    return $zalo;
}