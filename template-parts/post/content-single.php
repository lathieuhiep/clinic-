<div id="post-<?php the_ID() ?>" class="single-post-content">
    <h1 class="single-post-content__title f-family-body mt-5">
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