<?php $clinic_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" id="<?php echo $clinic_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Tìm kiếm', 'placeholder', 'clinic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="" />

    <button type="submit" class="search-submit">
        <i class="icon icon-search"></i>
    </button>
</form>