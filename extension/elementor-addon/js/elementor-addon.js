(function ($) {
    // setting owlCarousel
    const owlCarouselElementorOptions = (options) => {
        let defaults = {
            loop: true,
            smartSpeed: 800,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
            dragEndSpeed: 800,
            navText: ['<i class="icon-angle-left" aria-hidden="true"></i>','<i class="icon-angle-right" aria-hidden="true"></i>'],
        }

        // extend options
        return $.extend(defaults, options)
    }

    // element slider
    const elementSlider = ($scope, $) => {
        const slider = $scope.find('.element-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element testimonial slider
    const elementTestimonialSlider = ($scope, $) => {
        const slider = $scope.find('.element-testimonial-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element doctor slider
    const elementDoctorSlider = function ($scope, $) {
        const elementDoctorSlider = $scope.find('.element-doctor-slider__warp')

        if ( elementDoctorSlider.length ) {
            elementDoctorSlider.each(function () {
                const thisSlider = $(this)
                const options = {
                    responsive:{
                        0: {
                            items: 1,
                            autoHeight:true,
                            margin: 0
                        },
                        576: {
                            items: 2,
                            margin: 12
                        },
                        768: {
                            items: 3,
                            margin: 12
                        },
                        992: {
                            items: 4,
                            margin: 20
                        }
                    }
                }

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element package slider
    const elementPackageSlider = ($scope, $) => {
        const slider = $scope.find('.element-package-slider__warp')
        const options = slider.data('owl-options')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
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

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-package-slider.default', elementPackageSlider);
    });
})(jQuery);