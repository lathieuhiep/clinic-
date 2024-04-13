( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        // slider cate
        handleSliderCate()
    })

    // handle slider cate
    const handleSliderCate = () => {
        const slider = $('.cate-slider__warp')

        if ( slider.length ) {
            slider.each(function () {
                $(this).owlCarousel({
                    items: 1,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 800,
                    dragEndSpeed: 800
                })
            })
        }
    }

} )( jQuery )