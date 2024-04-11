</div><!--End Sticky Footer-->

<?php
if ( !is_404() ) :
?>
    <footer class="global-footer">
        <?php get_template_part( 'components/footer/inc','column' ); ?>
    </footer>
<?php
	get_template_part('components/header/inc','menu-mobile');
	get_template_part('components/inc','chat-with-us');
	get_template_part('components/inc','contact-us-mobile');
	get_template_part('components/inc','modal-medical-appointment');
endif;

wp_footer();
?>

</body>
</html>
