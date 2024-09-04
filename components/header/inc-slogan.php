<?php
$slogan = clinic_get_option( 'opt_general_slogan' );

if ( empty( $slogan ) ) {
    return false;
}
?>

<div class="slogan-warp">
    <div class="container">
        <div class="box">
            <?php echo esc_html( $slogan ) ?>
        </div>
    </div>
</div>