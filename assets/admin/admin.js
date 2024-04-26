( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        $('body').on('click', '#custom-button-upload', function(e){
            e.preventDefault()
            const obj_uploader = wp.media({
                title: 'Custom image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on('select', function() {
                var attachment = obj_uploader.state().get('selection').first().toJSON()
                const categoryBannerImage = $('#category_banner_image')
                categoryBannerImage.html('')
                categoryBannerImage.html(
                    "<img alt='' src=" + attachment.url + " style='width: 100%'>"
                )
                $('#category_banner_image_url').val(attachment.url)
                $("#custom-button-upload").hide()
                $("#custom-button-remove").show()
            }).open()
        });

        $(".custom-button-remove").click( function() {
            $('#category_banner_image').html('')
            $('#category_banner_image_url').val('')
            $(this).hide()
            $("#custom-button-upload").show()
        });
    })
} )( jQuery );