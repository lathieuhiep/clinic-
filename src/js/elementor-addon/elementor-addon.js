(function ($) {
    // element slider
    const elementSlider = ($scope, $) => {
        const slider = $scope.find('.element-slider__warp')

        if (slider.length) {
            slider.each(function () {
                $(this).lightSlider({
                    item: 1,
                    loop: true,
                    pager: false,
                    speed: 800,
                    currentPagerPosition: 'left'
                })
            })
        }
    }

    // element testimonial slider
    const elementTestimonialSlider = ($scope, $) => {
        const slider = $scope.find('.element-testimonial-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)

                thisSlider.lightSlider({
                    item: 3,
                    loop: true,
                    pager: false,
                    controls: false,
                    speed: 800,
                    slideMargin: 20,
                    currentPagerPosition: 'left',
                    responsive : [
                        {
                            breakpoint: 991,
                            settings: {
                                item: 2
                            }
                        },
                        {
                            breakpoint: 575,
                            settings: {
                                item: 1
                            }
                        }
                    ],
                    onSliderLoad: function (el) {
                        let maxHeight = 0,
                            container = $(el),
                            children = container.children();

                        children.each(function () {
                            const childHeight = $(this).height();
                            if (childHeight > maxHeight) {
                                maxHeight = childHeight;
                            }
                        });

                        container.height(maxHeight);
                    },
                })
            })
        }
    }

    // element doctor slider
    const elementDoctorSlider = function ($scope, $) {
        const elementDoctorSlider = $scope.find('.element-doctor-slider__gallery')

        if ( elementDoctorSlider.length ) {
            elementDoctorSlider.each(function () {
                const thisSlider = $(this)

                const slider = thisSlider.lightSlider({
                    item: 3,
                    loop: true,
                    pager: false,
                    controls: false,
                    speed: 800,
                    slideMargin: 20,
                    currentPagerPosition: 'left',
                    responsive : [
                        {
                            breakpoint: 767,
                            settings: {
                                item: 2
                            }
                        },
                        {
                            breakpoint: 575,
                            settings: {
                                item: 1
                            }
                        }
                    ],
                    onSliderLoad: function (el) {
                        let maxHeight = 0,
                            container = $(el),
                            children = container.children();
                        children.each(function () {
                            const childHeight = $(this).height();
                            if (childHeight > maxHeight) {
                                maxHeight = childHeight;
                            }
                        });
                        container.height(maxHeight);
                    },
                })

                $('.doctor-slider-button-prev').click(function () {
                    slider.goToPrevSlide();
                })

                $('.doctor-slider-button-next').click(function () {
                    slider.goToNextSlide();
                })
            })
        }
    }

    // element multiple rows slider
    const elementMultipleRowsSlider = function ($scope, $) {
        const slider = $scope.find('.element-carousel-multiple-rows__warp')

        if (slider.length) {
            slider.each(function () {
                $(this).lightSlider({
                    item: 1,
                    loop: true,
                    controls: false,
                    speed: 800,
                    currentPagerPosition: 'left'
                })
            })
        }
    }

    // element image slider
    const elementGallerySlider = function ($scope, $) {
        const slider = $scope.find('.element-image-slider__warp')

        if ( slider.length ) {
            slider.each(function () {
                const thisSlider = $(this)

                thisSlider.lightSlider({
                    item: 3,
                    loop: true,
                    pager: false,
                    controls: true,
                    speed: 800,
                    slideMargin: 20,
                    currentPagerPosition: 'left',
                    responsive : [
                        {
                            breakpoint: 767,
                            settings: {
                                item: 2
                            }
                        },
                        {
                            breakpoint: 375,
                            settings: {
                                item: 1
                            }
                        }
                    ],
                })
            })
        }
    }

    // element number counter
    const elementNumberCounter = ($scope, $) => {
        const numberCounter = $scope.find('.element-number-counter')
        let start = 0

        $( window ).scroll(function () {
            if ( numberCounter.length) {
                numberCounter.each(function () {

                    const thisNumberCounter = $(this)

                    const oTop = thisNumberCounter.find('.element-number-counter__warp').offset().top - window.innerHeight;

                    if ( start === 0 && $(window).scrollTop() > oTop ) {
                        const itemNumberCounter = thisNumberCounter.find('.content .number')

                        itemNumberCounter.each(function () {
                            const thisItemNumber = $(this)
                            const countTo = thisItemNumber.attr('data-number');

                            $({ countNum: thisItemNumber.text() }).animate(
                                {
                                    countNum: countTo
                                },
                                {
                                    duration: 850,
                                    easing: "swing",
                                    step: function () {
                                        thisItemNumber.text(
                                            Math.ceil(this.countNum)
                                        );
                                    },
                                    complete: function () {
                                        thisItemNumber.text(
                                            Math.ceil(this.countNum)
                                        );
                                    }
                                }
                            )
                        })

                        start = 1;
                    }
                })
            }
        })
    }

    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-slider.default', elementSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-testimonial-slider.default', elementTestimonialSlider);

        /* Element carousel images */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-carousel-multiple-rows.default', elementMultipleRowsSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorSlider);

        /* Element image slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-image-slider.default', elementGallerySlider);

        /* Element number count */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-number-counter.default', elementNumberCounter);
    });
})(jQuery);