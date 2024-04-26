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

// get chat zalo theme option general
function clinic_get_opt_chat_zalo()
{
    return clinic_get_option('opt_general_chat_zalo');
}