<?php
$show_related = clinic_get_option('opt_post_single_related', '1');
?>

<div id="post-<?php the_ID() ?>" class="single-post-content">
    <h1 class="single-post-content__title f-family-body">
		<?php the_title(); ?>
    </h1>

	<?php clinic_post_meta(); ?>

    <div class="single-post-content__detail">
		<?php the_content(); ?>
    </div>
</div>

<?php
get_template_part( 'components/inc','single-contact-us' );

get_template_part( 'components/inc','comment-form' );

if ( $show_related == '1' ) :
    get_template_part( 'template-parts/post/inc','related-post' );
endif;