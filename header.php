<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
wp_body_open();

if ( !is_404() ) :
    $sticky_menu = clinic_get_option( 'opt_menu_sticky', '1' );

    if ( wp_is_mobile() ) :
?>
    <header class="header-mobile <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
        <?php
        get_template_part('template-parts/header/inc','top-mobile');
        get_template_part('template-parts/header/inc','contact-mobile');
        ?>
    </header>

    <?php
        get_template_part('template-parts/header/inc','menu-mobile');
    else:
    ?>
        <header class="header-warp">
            <div class="container">
                <div class="grid">
                    <?php
                    get_template_part('template-parts/header/inc','info');

                    get_template_part('template-parts/header/inc','search');
                    ?>
                </div>
            </div>
        </header>

        <div class="header-menu <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
            <div class="container">
                <div class="grid">
                    <?php
                    get_template_part('template-parts/header/inc','logo');
                    get_template_part('template-parts/header/inc','main-navigation');
                    get_template_part('template-parts/header/inc','appointment');
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<!--Start Sticky Footer-->
<div class="sticky-footer">