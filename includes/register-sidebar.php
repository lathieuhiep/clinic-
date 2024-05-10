<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function clinic_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}

function clinic_multiple_widget_init(): void {
	clinic_widget_registration( esc_html__('Sidebar Main', 'clinic'), 'sidebar-main' );
	clinic_widget_registration( esc_html__('Sidebar Post', 'clinic'), 'sidebar-post', esc_html__('Display sidebar on post.', 'clinic') );

    // sidebar footer
    $opt_number_columns = clinic_get_option('opt_footer_columns', '4');

    for ( $i = 1; $i <= $opt_number_columns; $i++ ) {
        clinic_widget_registration( esc_html__('Sidebar Footer Column ' . $i, 'clinic'), 'sidebar-footer-column-' . $i );
    }
}

add_action('widgets_init', 'clinic_multiple_widget_init');