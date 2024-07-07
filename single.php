<?php
get_header();

$sidebar = clinic_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar( $sidebar, 'sidebar-post' );
?>

<div class="site-container single-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <div class="post-box">
                    <?php
                    get_template_part('components/inc', 'breadcrumbs');

                    if ( have_posts() ) : while (have_posts()) : the_post();
                        get_template_part( 'template-parts/post/content','single' );
                        endwhile;
                    endif;
                    ?>
                </div>

                <?php
                $show_related = clinic_get_option('opt_post_single_related', '1');

                if ( $show_related == '1' ) :
                    get_template_part( 'template-parts/post/inc','related-post' );
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

