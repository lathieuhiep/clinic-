<?php
get_template_part( 'template-parts/post/inc', 'cate-slider' );
get_template_part( 'components/inc', 'breadcrumbs' );

$sidebar = clinic_get_option('opt_post_cat_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar($sidebar, 'sidebar-main');
?>

<div class="site-container archive-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php if ( is_category() ): ?>
                <div class="top-box d-flex align-items-center">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
                            <path d="M2.74919 4.06885C2.24319 4.06885 1.83252 4.36751 1.83252 4.73551C1.83252 5.10351 2.24319 5.40218 2.74919 5.40218H19.2492C19.7552 5.40218 20.1659 5.10351 20.1659 4.73551C20.1659 4.36751 19.7552 4.06885 19.2492 4.06885H2.74919ZM2.74919 7.40218C2.24319 7.40218 1.83252 7.70085 1.83252 8.06885C1.83252 8.43685 2.24319 8.73551 2.74919 8.73551H19.2492C19.7552 8.73551 20.1659 8.43685 20.1659 8.06885C20.1659 7.70085 19.7552 7.40218 19.2492 7.40218H2.74919ZM2.74919 10.7355C2.24319 10.7355 1.83252 11.0342 1.83252 11.4022C1.83252 11.7702 2.24319 12.0688 2.74919 12.0688H19.2492C19.7552 12.0688 20.1659 11.7702 20.1659 11.4022C20.1659 11.0342 19.7552 10.7355 19.2492 10.7355H2.74919Z" fill="white"/>
                        </svg>
                    </div>

                    <h1 class="cate-name m-0">
                        <?php single_cat_title(); ?>
                    </h1>
                </div>
                <?php endif; ?>

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

                                    <div class="post-meta">
                                        <p class="date">
                                            <?php echo get_the_date('j F, Y') ?>
                                        </p>
                                    </div>

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
		                                <?php esc_html_e('Đọc tiếp', 'clinic'); ?> »
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