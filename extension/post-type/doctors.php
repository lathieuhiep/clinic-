<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'clinic_create_doctor', 10);

function clinic_create_doctor(): void
{
    /* Start post type template */
    $labels = array(
        'name' => _x('Đội ngũ bác sĩ', 'post type general name', 'clinic'),
        'singular_name' => _x('Đội ngũ bác sĩ', 'post type singular name', 'clinic'),
        'menu_name' => _x('Đội ngũ bác sĩ', 'admin menu', 'clinic'),
        'name_admin_bar' => _x('Danh sách bác sĩ', 'add new on admin bar', 'clinic'),
        'add_new' => _x('Thêm mới', 'Bác sĩ', 'clinic'),
        'add_new_item' => esc_html__('Thêm', 'clinic'),
        'edit_item' => esc_html__('Sửa', 'clinic'),
        'new_item' => esc_html__('Bác sĩ mới', 'clinic'),
        'view_item' => esc_html__('Xem', 'clinic'),
        'all_items' => esc_html__('Tất cả', 'clinic'),
        'search_items' => esc_html__('Tìm kiếm', 'clinic'),
        'not_found' => esc_html__('Không tìm thấy', 'clinic'),
        'not_found_in_trash' => esc_html__('Không tìm thấy trong thùng rác', 'clinic'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-groups',
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'bac-si'),
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('clinic_doctor', $args);
    /* End post type template */
}