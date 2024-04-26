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
		'name'    => esc_html__('Ảnh đại diện', 'clinic'),
		'id'      => 'clinic_cmb_doctor_avatar',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false,
		),
		'text'    => array(
			'add_upload_file_text' => 'Chọn ảnh'
		),
		'query_args' => array(
			 'type' => array(
				 'image/jpg',
			     'image/jpeg',
			     'image/png',
			 )
		),
		'preview_size' => 'medium',
	) );

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

	$cmb->add_field( array(
		'id' => 'clinic_cmb_doctor_content',
		'type' => 'textarea',
		'name' => esc_html__( 'Mô tả', 'clinic' ),
		'desc' => esc_html__('Enter để xuống dòng tạo danh sách', 'clinic')
	) );
}