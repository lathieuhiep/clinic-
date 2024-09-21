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
        // slider main
        const syncedSecondary = true;
        const slider = $scope.find('.element-doctor-slider__warp')
        const sliderThumbnail = $scope.find('.element-doctor-avatar__slider')
        const options = slider.data('owl-options')

        if ( slider.length ) {
            slider.each(function () {
                const thisSlider = $(this)
                const parent = thisSlider.closest('.element-doctor-slider')
                const sync2 = parent.find('.element-doctor-avatar__slider')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
                    .on('changed.owl.carousel', function (el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;

                    //if you disable loop you have to comment this block
                    const count = el.item.count - 1;
                    let current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2.find(".owl-item").removeClass("current").eq(current).addClass("current")
                    const onscreen = sync2.find('.owl-item.active').length - 1;
                    const start = sync2.find('.owl-item.active').first().index();
                    const end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                });
            })
        }

        // slider thumbnail
        if ( sliderThumbnail.length ) {
            sliderThumbnail.each(function () {
                const thisSlider = $(this)
                const parent = thisSlider.closest('.element-doctor-slider')
                const sync1 = parent.find('.element-doctor-slider__warp')
                
                thisSlider.on('initialized.owl.carousel', function() {
                    thisSlider.find(".owl-item").eq(0).addClass("current");
                }).owlCarousel(owlCarouselElementorOptions({
                    loop: false,
                    items: 4
                })).on('changed.owl.carousel', function (el) {
                    if (syncedSecondary) {
                        const number = el.item.index;
                        sync1.data('owl.carousel').to(number, 800, true);
                    }
                })

                thisSlider.on("click", ".owl-item", function(e) {
                    e.preventDefault();

                    const number = $(this).index();
                    sync1.data('owl.carousel').to(number, 800, true);
                });
            })
        }

        function syncPosition(el) {

        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                const number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
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