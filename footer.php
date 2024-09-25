</div><!--End Sticky Footer-->

<?php
get_template_part('components/inc','loading');

if ( !is_404() ) :
    if ( !wp_is_mobile() ) {
        get_template_part('components/inc','contact-us');
    }

    get_template_part('components/inc','chat-with-us');
    get_template_part('components/inc','modal-appointment');
?>
    <footer class="global-footer">
        <?php get_template_part( 'template-parts/footer/inc','column' ); ?>
    </footer>
<?php
    if ( wp_is_mobile() ) {
        get_template_part('components/inc','contact-us-mobile');
    }
endif;

wp_footer();
?>

</body>
</html>
