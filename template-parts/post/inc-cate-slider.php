<?php
$gallery_ids = clinic_get_post_cat_slider();

if ( $gallery_ids ) :
?>

<div class="cate-slider">
    <div class="cate-slider__warp owl-carousel owl-theme">
        <?php foreach ( $gallery_ids as $gallery_item_id ): ?>
            <div class="item">
                <?php echo wp_get_attachment_image( $gallery_item_id, 'full' ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
endif;