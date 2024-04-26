<?php
get_header();

$sidebar = clinic_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar( $sidebar, 'sidebar-main' );

// get category
$category = get_the_category();
$category_parent_id = $category[0]->category_parent;

if ( $category_parent_id != 0 ) {
	$term_id = $category_parent_id;
} else {
	$term_id = $category[0]->term_id;
}

// get banner category
$term_image_url = get_term_meta( $term_id, 'term_banner_image', true );

// include breadcrumbs
get_template_part( 'components/inc', 'breadcrumbs' );

if ( $term_image_url ) :
?>
    <div class="banner-cate">
        <div class="container">
            <div class="image-warp">
                <img src="<?php echo esc_url( $term_image_url ); ?>" width="1920" height="500" alt="">
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="site-container single-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single', array(
                            'term_id' => $term_id
                    ) );

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

