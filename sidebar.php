<?php if( is_active_sidebar( 'sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( clinic_col_sidebar() ); ?> site-sidebar order-1">
        <div class="site-sidebar__inner">
            <?php dynamic_sidebar( 'sidebar-main' ); ?>
        </div>
    </aside>

<?php endif; ?>