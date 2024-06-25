<?php
get_header();

$sidebar = clinic_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar( $sidebar, 'sidebar-post' );

// banner
$banner_pc = clinic_get_option('opt_general_banner_pc');
$banner_mobile = clinic_get_option('opt_general_banner_mobile');
?>

<?php if ( $banner_pc ) : ?>
    <div class="element-banner">
        <div class="banner-pc">
		    <?php echo wp_get_attachment_image( $banner_pc['id'], 'full' ); ?>
        </div>

	    <?php if ( !empty( $banner_mobile ) ) : ?>
            <div class="banner-mobile">
			    <?php echo wp_get_attachment_image( $banner_mobile['id'], 'full' ); ?>
            </div>
	    <?php endif; ?>
    </div>
<?php
endif;

get_template_part( 'components/inc', 'breadcrumbs' );
?>

<div class="site-container single-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();
                    get_template_part( 'template-parts/post/content','single' );
                    endwhile;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' ) :
	            get_sidebar('post');
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

