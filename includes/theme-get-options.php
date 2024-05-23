<?php
// get hotline theme option general
function clinic_get_opt_hotline()
{
    return clinic_get_option('opt_general_hotline');
}

// get address options
function clinic_get_opt_general_address()
{
    return clinic_get_option('opt_general_address');
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

// get link chat doctor theme option general
function clinic_get_opt_link_chat_messenger()
{
    return clinic_get_option('opt_general_chat_messenger');
}

// get chat zalo theme option general
function clinic_get_opt_chat_zalo()
{
	return clinic_get_option('opt_general_chat_zalo');
}

// get slider theme option general
function clinic_get_general_slider(): array
{
    $gallery = clinic_get_option('opt_general_slider');
    $gallery_ids = [];

    if ( !empty( $gallery ) ) {
        $gallery_ids = explode( ',', $gallery );
    }

    return $gallery_ids;
}