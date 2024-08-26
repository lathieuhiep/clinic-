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
                const options = {
                    margin: 50,
                    responsive:{
                        0:{
                            items: 1,
                            margin: 12,
                        },
                        576:{
                            items: 2,
                            margin: 24,
                        },
                        992:{
                            items: 3
                        }
                    }
                }

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element doctor slider
    const elementDoctorSlider = function ($scope, $) {
        const slider = $scope.find('.element-doctor-slider__warp')
        const options = slider.data('owl-options')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element doctor slider modal detail
    const elementDoctorModalDetail = ($scope, $) => {
        const btnDoctorDetail = $scope.find('.btn-doctor-detail')
        const modalDetail = $scope.find('.modal-doctor-detail')
        const titleDetail = modalDetail.find('.modal-title')
        const contentDetail = modalDetail.find('.modal-body')

        // call ajax doctor detail
        btnDoctorDetail.on('click', function () {
            const thisBtn = $(this)
            const postId = thisBtn.data('id')

            $.ajax({
                url: clinicElementAjax.url,
                type: 'POST',
                dataType: 'json',
                data: ({
                    action: 'clinic_elementor_ajax_doctor_detail',
                    postId: postId
                }),
                beforeSend: function () {
                    thisBtn.prop('disabled', true)
                    thisBtn.find('.icon').fadeIn()
                },
                success:function (response) {
                    titleDetail.html(response.data.title)
                    contentDetail.html(response.data.html)

                    modalDetail.modal('show')
                },
                complete: function () {
                    thisBtn.prop('disabled', false)
                    thisBtn.find('.icon').fadeOut()
                }
            })
        })

        // event hidden modal
        modalDetail.on('hidden.bs.modal', function () {
            contentDetail.empty()
        })

        // event show form contact
        const btnContactModal = $scope.find('.btn-contact-modal')

        btnContactModal.on('click', function () {
            modalDetail.modal('hide')
            $('#modal-appointment-form').modal('show')
        })
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
        // Element slider
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-slider.default', elementSlider)

        // Element testimonial slider
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-testimonial-slider.default', elementTestimonialSlider)

        // Element doctor slider
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorSlider)

        // element doctor slider modal detail
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorModalDetail)

        // Element package slider
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-package-slider.default', elementPackageSlider)
    });
})(jQuery);