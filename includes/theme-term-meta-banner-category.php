<?php
// add field upload banner image
add_action( 'category_add_form_fields', 'clinic_category_add_form_fields_callback' );
function clinic_category_add_form_fields_callback(): void {
	?>
    <div class="form-field term-banner-wrap">
        <div id="category_banner_image"></div>

        <input type="hidden" id="category_banner_image_url" name="category_banner_image_url">

        <div style="margin-bottom: 20px;">
            <p>
				<?php esc_html_e('Banner Image', 'clinic'); ?>
            </p>

            <a href="#" class="button custom-button-upload" id="custom-button-upload">Upload image</a>

            <a href="#" class="button custom-button-remove" id="custom-button-remove" style="display: none">Remove image</a>
        </div>
    </div>
	<?php
}

// create meta key banner image and save
add_action( 'create_term', 'clinic_custom_create_term_callback' );
function clinic_custom_create_term_callback($term_id, $tt_id, $taxonomy): void {
	if ( $taxonomy == 'category' ) {
		add_term_meta(
			$term_id,
			'term_banner_image',
			esc_url($_REQUEST['category_banner_image_url'])
		);
	}
}

// show banner image edit
add_action ( 'category_edit_form_fields', 'clinic_category_edit_form_fields_callback', 10, 2 );
function clinic_category_edit_form_fields_callback($ttObj, $taxonomy): void {
    if ( $taxonomy == 'category' ) :
        $term_id = $ttObj->term_id;
        $image = get_term_meta( $term_id, 'term_banner_image', true );
?>

    <tr class="form-field term-image-wrap">
        <th scope="row">
            <label for="image"><?php esc_html_e('Banner Image', 'clinic'); ?></label>
        </th>

        <td>
			<?php if ( $image ): ?>

                <div id="category_banner_image">
                    <img src="<?php echo esc_url( $image ); ?>" style="max-width: 100%" alt=""/>
                </div>

                <input type="hidden" id="category_banner_image_url" name="category_banner_image_url">

                <div>
                    <a href="#"
                       class="button custom-button-upload"
                       id="custom-button-upload"
                       style="display: none">Upload image</a>
                    <a href="#" class="button custom-button-remove">Remove image</a>
                </div>

			<?php else: ?>

                <div id="category_banner_image"></div>

                <input type="hidden" id="category_banner_image_url" name="category_banner_image_url">

                <div>
                    <a href="#" class="button custom-button-upload" id="custom-button-upload">Upload image</a>

                    <a href="#" class="button custom-button-remove" style="display: none">Remove image</a>
                </div>
			<?php endif; ?>
        </td>
    </tr>

<?php
    endif;
}

// change banner image when edit category
add_action( 'edit_term', 'clinic_edit_term_callback', 10, 3 );
function clinic_edit_term_callback($term_id, $tt_id, $taxonomy): void {
	if ( $taxonomy == 'category' ) {
		$image = get_term_meta( $term_id, 'term_banner_image' );
		if ( $image ) :
			update_term_meta(
				$term_id,
				'term_banner_image',
				esc_url( $_POST['category_banner_image_url']) );
		else :
			add_term_meta(
				$term_id,
				'term_banner_image',
				esc_url( $_POST['category_banner_image_url']) );
		endif;
	}
}