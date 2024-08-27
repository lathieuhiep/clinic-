(function ($) {
    // Hàm kiểm tra nếu phần tử trong khung nhìn
    const isElementInViewport = (element) => {
        const rect = element.getBoundingClientRect(); // Lấy vị trí phần tử
        const windowHeight = window.innerHeight; // Chiều cao cửa sổ

        // Kiểm tra nếu phần tử trong khung nhìn
        return rect.top >= 0 && rect.bottom <= windowHeight;
    }

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
    const elementDoctorSlider = ($scope, $) => {
        const slider = $scope.find('.element-doctor-slider__warp')

        if ( slider.length ) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = {
                    dots: false,
                    nav: true,
                    responsive:{
                        0: {
                            items: 1,
                            stagePadding: 6,
                            margin: 12
                        },
                        576: {
                            items: 2,
                            stagePadding: 20,
                            margin: 12
                        },
                        992: {
                            items: 3,
                            stagePadding: 20,
                            margin: 30
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

    // element circular progress
    const elementCircularProgress = ($scope, $) => {
        $(window).on('scroll', function() {
            const progressCircle = $scope.find('.element-circular-progress');

            if ( progressCircle.length ) {
                progressCircle.each(function () {
                    const thisProgressCircle = $(this)

                    if ( isElementInViewport(thisProgressCircle[0]) ) {
                        const circularProgressItem = $(this).find('.item')

                        circularProgressItem.each(function () {
                            const thisCircularProgress = $(this)
                            const progressCircleFill = thisCircularProgress.find('.progress-circle-fill')

                            const progressValue = thisCircularProgress.data('progress')
                            const radius = 65;
                            const circumference = 2 * Math.PI * radius
                            const dashOffset = ( circumference * ( (100 - progressValue) / 100 ) + 15 ).toString(); // Đối ứng với phần trăm

                            progressCircleFill.css('stroke-dashoffset', dashOffset);
                        })
                    }
                })
            }
        })
    }

    // element cate list slider
    const elementCateListSlider = ($scope, $) => {
        const slider = $scope.find('.element-cate-list-slider__warp')

        if ( slider.length ) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = {
                    dots: false,
                    nav: true,
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


    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-slider.default', elementSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-testimonial-slider.default', elementTestimonialSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-package-slider.default', elementPackageSlider);

        /* Element cate list slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-category-list-slider.default', elementCateListSlider);

        /* Element circular progress */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-circular-progress.default', elementCircularProgress);
    });
})(jQuery);