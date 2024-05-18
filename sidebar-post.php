<?php if( is_active_sidebar( 'sidebar-post' ) ): ?>

	<aside class="<?php echo esc_attr( clinic_col_sidebar() ); ?> site-sidebar order-1">
		<?php dynamic_sidebar( 'sidebar-post' ); ?>
	</aside>

<?php endif; ?>