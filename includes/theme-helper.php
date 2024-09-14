<?php
//
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");
function disable_gutenberg_editor(): false
{
    return false;
}

// get version theme
function clinic_get_version_theme(): string
{
    return wp_get_theme()->get('Version');
}

// check is blog
function clinic_is_blog(): bool
{
    return (is_archive() || is_category() || is_tag() || is_author() || is_home() || is_search());
}

// Callback Comment List
function clinic_comments($clinic_comment, $clinic_comment_args, $clinic_comment_depth): void
{
    if ($clinic_comment_args['style'] == 'div') :
        $clinic_comment_tag = 'div';
        $clinic_comment_add_below = 'comment';
    else :
        $clinic_comment_tag = 'li';
        $clinic_comment_add_below = 'div-comment';
    endif;

    ?>
    <<?php echo $clinic_comment_tag ?><?php comment_class(empty($clinic_comment_args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

    <?php if ('div' != $clinic_comment_args['style']) : ?>

    <div id="div-comment-<?php comment_ID() ?>" class="comment__body">

<?php endif; ?>
    <div class="author vcard">
        <div class="author__avatar">
            <?php if ($clinic_comment_args['avatar_size'] != 0) {
                echo get_avatar($clinic_comment, $clinic_comment_args['avatar_size']);
            } ?>
        </div>

        <div class="author__info">
            <span class="name"><?php comment_author_link(); ?></span>

            <span class="date"><?php comment_date(); ?></span>
        </div>
    </div>

    <?php if ($clinic_comment->comment_approved == '0') : ?>
    <div class="awaiting">
        <?php esc_html_e('Your comment is awaiting moderation.', 'clinic'); ?>
    </div>
<?php endif; ?>

    <div class="content">
        <?php comment_text(); ?>
    </div>

    <div class="action">
        <?php edit_comment_link(esc_html__('Edit ', 'clinic')); ?>

        <?php comment_reply_link(array_merge($clinic_comment_args, array(
            'add_below' => $clinic_comment_add_below,
            'depth' => $clinic_comment_depth,
            'max_depth' => $clinic_comment_args['max_depth']
        ))); ?>
    </div>

    <?php if ($clinic_comment_args['style'] != 'div') : ?>

    </div>

<?php
endif;
}

// Content Nav
function clinic_comment_nav(): void
{
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation">
            <h2 class="screen-reader-text">
                <?php esc_html_e('Comment navigation', 'clinic'); ?>
            </h2>

            <div class="nav-links">
                <?php
                if ($prev_link = get_previous_comments_link(esc_html__('Older Comments', 'clinic'))) :
                    printf('<div class="nav-previous">%s</div>', $prev_link);
                endif;

                if ($next_link = get_next_comments_link(esc_html__('Newer Comments', 'clinic'))) :
                    printf('<div class="nav-next">%s</div>', $next_link);
                endif;
                ?>
            </div>
        </nav>
    <?php
    endif;
}

// Pagination
function clinic_pagination(): void
{
    the_posts_pagination(array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => '<<',
        'next_text' => '>>',
        'screen_reader_text' => '&nbsp;',
    ));
}

// Pagination Nav Query
function clinic_paging_nav_query($query): void
{

    $args = array(
        'prev_text' => esc_html__(' Previous', 'clinic'),
        'next_text' => esc_html__('Next', 'clinic'),
        'current' => max(1, get_query_var('paged')),
        'total' => $query->max_num_pages,
        'type' => 'list',
    );

    $paginate_links = paginate_links($args);

    if ($paginate_links) :

        ?>
        <nav class="pagination">
            <?php echo $paginate_links; ?>
        </nav>

    <?php

    endif;
}

// Get col global
function clinic_col_use_sidebar($option_sidebar, $active_sidebar): string
{
    if ($option_sidebar != 'hide' && is_active_sidebar($active_sidebar)):

        if ($option_sidebar == 'left') :
            $class_position_sidebar = ' order-1 order-md-2';
        else:
            $class_position_sidebar = ' order-1';
        endif;

        $class_col_content = 'col-12 col-md-8 col-lg-9' . $class_position_sidebar;
    else:
        $class_col_content = 'col-md-12';
    endif;

    return $class_col_content;
}

function clinic_col_sidebar(): string
{
    return 'col-12 col-md-4 col-lg-3';
}

// Link Pages
function clinic_link_page(): void
{
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'clinic'),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
    ));
}

// Get Category Check Box
function clinic_check_get_cat($type_taxonomy): array
{
    $cat_check = array();
    $category = get_terms(
        array(
            'taxonomy' => $type_taxonomy,
            'hide_empty' => false
        )
    );

    if (!empty($category)):
        foreach ($category as $item) {
            $cat_check[$item->term_id] = $item->name;
        }
    endif;

    return $cat_check;
}

// Get Contact Form 7
function clinic_get_form_cf7(): array
{
    $options = array();

    if (function_exists('wpcf7')) {

        $wpcf7_form_list = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'numberposts' => -1,
        ));

        $options[0] = esc_html__('Select a Contact Form', 'clinic');

        if (!empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list)) :
            foreach ($wpcf7_form_list as $item) :
                $options[$item->ID] = $item->post_title;
            endforeach;
        else :
            $options[0] = esc_html__('Create a Form First', 'clinic');
        endif;

    }

    return $options;
}

// replace number
function clinic_preg_replace_ony_number($string): string|null
{
    $number = '';

    if (!empty($string)) {
        $number = preg_replace('/[^0-9]/', '', strip_tags($string));
    }

    return $number;
}

//
function clinic_get_chat_zalo(): array
{
    $chat_zalo = clinic_get_opt_chat_zalo();

    $zalo = array(
        'class' => '',
        'target' => '_self',
        'phone' => '',
        'qr_code' => '',
        'link' => ''
    );

    if( !empty( $chat_zalo ) ) {
        $zalo_select = $chat_zalo['select_zalo'];
        $zalo['phone'] = $chat_zalo['phone'];

        if ( $zalo_select == 'phone_qr' ) :
            $zalo['class'] = ' chat-with-us__zalo';
            $zalo['qr_code'] = $chat_zalo['qr_code'];
            $zalo['link'] = 'https://zalo.me/' . clinic_preg_replace_ony_number( $zalo['phone'] );
        else:
            $zalo['target'] = '_blank';
            $zalo['link'] = $chat_zalo['link'];
        endif;
    }

    return $zalo;
}