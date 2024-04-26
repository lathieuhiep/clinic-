(function ($) {
    // element slider
    const elementSlider = ($scope, $) => {
        const slider = $scope.find('.element-slider__warp')

        if (slider.length) {
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

    // element testimonial slider
    const elementTestimonialSlider = ($scope, $) => {
        const slider = $scope.find('.element-testimonial-slider__warp')

        if (slider.length) {
            slider.each(function () {
                slider.owlCarousel({
                    loop: false,
                    margin: 50,
                    dotsSpeed: 800,
                    dragEndSpeed: 800,
                    responsive:{
                        0:{
                            items: 1
                        },
                        576:{
                            items: 2
                        },
                        992:{
                            items: 3
                        }
                    }
                })
            })
        }
    }

    // element doctor slider
    const elementDoctorSlider = function ($scope, $) {
        const elementDoctorSlider = $scope.find('.element-doctor-slider__warp')

        if ( elementDoctorSlider.length ) {
            elementDoctorSlider.each(function () {
                const thisSlider = $(this)

                thisSlider.owlCarousel({
                    loop: false,
                    margin: 22,
                    dotsSpeed: 800,
                    dragEndSpeed: 800,
                    responsive:{
                        0:{
                            items: 1,
                            autoHeight:true,
                            margin: 0
                        },
                        576:{
                            items: 2,
                            margin: 12
                        },
                        768:{
                            items: 3,
                            margin: 12
                        }
                    }
                })
            })
        }
    }

    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-slider.default', elementSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-testimonial-slider.default', elementTestimonialSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorSlider);
    });
})(jQuery);