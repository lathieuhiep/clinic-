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
    get_template_part('components/inc','contact-us');
?>
    <footer class="global-footer">
        <?php get_template_part( 'components/footer/inc','column' ); ?>
    </footer>
<?php
	get_template_part('components/header/inc','menu-mobile');
	get_template_part('components/inc','chat-with-us');
endif;

wp_footer();
?>

</body>
</html>
