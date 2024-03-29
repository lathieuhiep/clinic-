</div><!--End Sticky Footer-->

<?php
$opt_back_to_top = clinic_get_option( 'opt_general_back_to_top', '1' );

get_template_part('components/inc','loading');

if ( $opt_back_to_top == '1' ) :
?>
    <div id="back-top">
        <a href="#">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
<?php
endif;

if ( !is_404() ) :
    $code_map = clinic_get_option('opt_footer_map');
?>
    <footer class="global-footer">
        <div class="global-footer__warp">
            <?php
            get_template_part( 'components/footer/inc','logo' );

            get_template_part( 'components/footer/inc','column' );
            ?>
        </div>

        <?php if ( $code_map ): ?>
            <div class="global-footer__sidebar-full">
	            <?php echo $code_map; ?>
            </div>
        <?php endif; ?>
    </footer>
<?php
	get_template_part('components/header/inc','menu-mobile');
	get_template_part('components/inc','chat-with-us');
	get_template_part('components/inc','contact-us-mobile');

    if ( is_front_page() || is_singular('post') ) {
	    get_template_part('components/inc','popup-contact');
    }
endif;

wp_footer();
?>

</body>
</html>
