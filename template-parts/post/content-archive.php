<?php
get_template_part( 'components/inc', 'breadcrumbs' );

$sidebar = clinic_get_option('opt_post_cat_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar($sidebar, 'sidebar-main');

$term_image_url = '';
if ( is_archive() || is_category() ) {
	$category = get_queried_object();
    $category_parent_id = $category->category_parent;

	if ( $category_parent_id != 0 ) {
		$term_id = $category_parent_id;
	} else {
		$term_id = $category->term_id;
	}

	$term_image_url = get_term_meta( $term_id, 'term_banner_image', true );
}
?>

<?php if ( $term_image_url ) : ?>
    <div class="banner-cate">
        <div class="container">
            <div class="image-warp">
                <img src="<?php echo esc_url( $term_image_url ); ?>" width="1920" height="500" alt="">
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="site-container archive-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="content-archive-post">
		                <?php
		                while ( have_posts() ) :
			                the_post();
                        ?>
                            <div class="item">
                                <div class="post-thumbnail">
		                            <?php the_post_thumbnail('large'); ?>
                                </div>

                                <div class="item__content">
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							                <?php if (is_sticky() && is_home()) : ?>
                                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
							                <?php
							                endif;

							                the_title();
							                ?>
                                        </a>
                                    </h2>

                                    <div class="post-desc">
                                        <p>
							                <?php
							                if (has_excerpt()) :
								                echo esc_html(get_the_excerpt());
							                else:
								                echo wp_trim_words(get_the_content(), 30, '...');
							                endif;
							                ?>
                                        </p>

						                <?php clinic_link_page(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="text-read-more">
		                                <?php esc_html_e('Chi tiết', 'clinic'); ?> >
                                    </a>
                                </div>
                            </div>
		                <?php
		                endwhile;
		                wp_reset_postdata();
		                ?>
                    </div>
                <?php
	                clinic_pagination();
                else:
	                if ( is_search() ) :
		                get_template_part('template-parts/post/content', 'no-data');
	                endif;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>