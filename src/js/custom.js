/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {

        // handle click back to top
        $('#back-top').on( 'click', function (e) {
            e.preventDefault()
            $('html').scrollTop(0)
        } )

        // handle dropdown category widget
        handleDropdownCategoryWidget()

        // handle slider manin
        handleSliderMain()

        // handle click zalo
        handleZaLoClick()
    })

    // loading
    $( window ).on( "load", function() {
        // handle remove loading page after loaded successfully
        handleRemoveLoadingPage()
    })

    // scroll event
    $( window ).scroll( function() {
        if ( timer_clear ) clearTimeout(timer_clear)

        timer_clear = setTimeout( function() {
            /* Start scroll back top */
            const $scrollTop = $(this).scrollTop();

            if ( $scrollTop > 200 ) {
                $('#back-top').addClass('active_top')
            } else {
                $('#back-top').removeClass('active_top')
            }
            /* End scroll back top */
        }, 100 );

    })

    /*
    ** Function
    * */

    // handle remove loading page after loaded successfully
    const handleRemoveLoadingPage = () => {
        const siteLoading = $( '#site-loading' )

        if ( siteLoading.length ) {
            siteLoading.remove()
        }
    }

    // handle dropdown category widget
    const handleDropdownCategoryWidget = () => {
        // handle show cate current
        const cateItemLink = $('.categories-dropdown-widget .cat-item__link')
        if ( cateItemLink.length ) {
            cateItemLink.each(function () {
                const hasClassCurrent = $(this).hasClass('current-cate')

                if ( hasClassCurrent ) {
                    const catItemParent = $(this).closest('.cat-item-parent')

                    catItemParent.children('.cate-link-has-child').addClass('active')
                    catItemParent.children( '.children' ).slideDown()
                }
            })
        }

        // handle slideToggle
        const cateLinkHasChildWidget = $('.categories-dropdown-widget .cate-link-has-child')
        if ( cateLinkHasChildWidget.length ) {
            cateLinkHasChildWidget.each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault()

                    $(this).toggleClass('active')
                    $(this).closest( '.cat-item' ).siblings().find(cateLinkHasChildWidget).removeClass( 'active' )
                    $(this).parent().children( '.children' ).slideToggle()
                    $(this).parents( '.cat-item-has-child' ).siblings().find('.children').slideUp();
                })
            })
        }
    }

    // handle slider main
    const handleSliderMain = () => {
        const sliderMain = $('.slider-main__warp')

        if ( sliderMain.length ) {
            sliderMain.each(function () {
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

    // handle click zalo
    const handleZaLoClick = () => {
        const chatWithUsZalo = $('.chat-with-us__zalo')

        if ( chatWithUsZalo.length ) {
            chatWithUsZalo.on('click', function (e) {
                e.preventDefault()

                let link;
                const phone = $(this).data('phone')
                const qrCode = $(this).data('qr-code')

                // check Device
                const isMobileDevice = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                const isAndroid = /Android/i.test(navigator.userAgent);

                if (isMobileDevice ) {
                    if ( isAndroid ) {
                        // android
                        link = `https://zaloapp.com/qr/p/${qrCode}`;
                    } else {
                        // ios
                        link = `zalo://qr/p/${qrCode}`;
                    }
                } else {
                    // pc
                    link = `https://zalo.me/${phone}`;
                }

                window.open(link, '_blank');
            })
        }
    }
} )( jQuery );