<?php
add_action('cmb2_admin_init', 'clinic_meta_boxes_doctor');
function clinic_meta_boxes_doctor(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'clinic_cmb_doctor',
        'title' => esc_html__('Thông tin bổ sung', 'clinic'),
        'object_types' => array('clinic_doctor'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'clinic_cmb_doctor_position',
        'type' => 'text',
        'name' => esc_html__( 'Chức vụ', 'clinic' )
    ) );

    $cmb->add_field( array(
        'id'   => 'clinic_cmb_doctor_specialist',
        'type' => 'text',
        'name' => esc_html__( 'Chuyên khoa', 'clinic' )
    ) );
}