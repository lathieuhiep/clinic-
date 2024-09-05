<?php $clinic_unique_id = esc_attr(uniqid('search-form-')); ?>

<div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php esc_html_e('Nhập từ khóa cần tìm kiếm', 'clinic'); ?></h3>
            </div>

            <div class="modal-body">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" id="<?php echo $clinic_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Gõ từ khóa tìm kiếm...', 'placeholder', 'clinic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="" />

                    <div class="group-action">
                        <button type="submit" class="btn btn-search-submit"><?php esc_html_e('Tìm', 'clinic'); ?></button>

                        <button type="button" class="btn btn-close-modal" data-bs-dismiss="modal"><?php esc_html_e('Đóng', 'clinic'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>