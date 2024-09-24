( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        sliderMain()
    })

    // handle slider main
    const sliderMain = () => {
      const slider = $('.slider-main__warp');

      if (slider.length) {
          slider.owlCarousel({
              items: 1,
              nav: true,
              loop: true,
              smartSpeed: 800,
              autoplaySpeed: 800,
              navSpeed: 800,
              dotsSpeed: 800,
              dragEndSpeed: 800,
              navText: ['<i class="icon-angle-left" aria-hidden="true"></i>','<i class="icon-angle-right" aria-hidden="true"></i>'],
          })
      }
    }
} )( jQuery );