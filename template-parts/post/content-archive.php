<?php
$sidebar = clinic_get_option('opt_post_cat_sidebar_position', 'right');
$class_col_content = clinic_col_use_sidebar($sidebar, 'sidebar-main');
$layout_grid = clinic_get_option('opt_post_cat_grid');

if ( empty( $layout_grid ) ) :
    $layout_grid_sm = 12;
    $layout_grid_md = 6;
    $layout_grid_lg = 4;
    $layout_grid_xl= 4;
else:
    $layout_grid_sm = $layout_grid['sm'];
    $layout_grid_md = $layout_grid['md'];
    $layout_grid_lg = $layout_grid['lg'];
    $layout_grid_xl= $layout_grid['xl'];
endif;
?>

<div class="site-container archive-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="content-archive-post">
                        <div class="row">
                            <?php while ( have_posts() ) : the_post(); ?>

                                <div class="col-12 col-sm-<?php echo esc_attr( $layout_grid_sm ); ?> col-md-<?php echo esc_attr( $layout_grid_md ); ?> col-lg-<?php echo esc_attr( $layout_grid_lg ); ?> col-xl-<?php echo esc_attr( $layout_grid_xl ); ?>">
                                    <div class="item">
                                        <div class="post-thumbnail">
                                            <?php the_post_thumbnail('large'); ?>
                                        </div>

                                        <div class="item__content">
                                            <div class="meta">
                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 7V1L9 1.5L14 7L8.5 12.5L3 7Z" fill="#A79E7C" stroke="#A79E7C"/>
                                                    <path d="M1 7.26087V1L7.54545 1.52174L13 7.26087L7 13L1 7.26087Z" fill="#A79E7C" stroke="#FEFEFE" stroke-width="0.5"/>
                                                    <circle cx="4" cy="4" r="1" fill="white"/>
                                                </svg>


                                                <div class="meta__cate">
                                                    <?php the_category(', '); ?>
                                                </div>
                                            </div>

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

                                            <div class="action-box text-end">
                                                <a href="<?php the_permalink(); ?>" class="text-read-more text-uppercase">
                                                    <?php esc_html_e('Chi tiết', 'clinic'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
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