<?php
add_action('cmb2_admin_init', 'clinic_meta_boxes_doctor');
function clinic_meta_boxes_doctor(): void {
	$cmb = new_cmb2_box(array(
		'id' => 'clinic_cmb_doctor',
		'title' => esc_html__('Thông tin bổ sung', 'clinic'),
		'object_types' => array('clinic_doctor'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
	));

	$cmb->add_field( array(
		'id'   => 'clinic_cmb_doctor_position',
		'type' => 'text',
		'name' => esc_html__( 'Chức vụ', 'clinic' )
	) );

	$cmb->add_field( array(
		'id'   => 'clinic_cmb_doctor_specialist',
		'type' => 'textarea',
		'name' => esc_html__( 'Chuyên khoa', 'clinic' ),
        'attributes' => array(
            'rows' => 6
        ),
	) );

	$cmb->add_field( array(
		'id'   => 'clinic_cmb_doctor_treatment_of',
		'type' => 'textarea',
		'name' => esc_html__( 'Khám và điều trị các bệnh', 'clinic' ),
        'attributes' => array(
            'rows' => 6
        ),
	) );
}