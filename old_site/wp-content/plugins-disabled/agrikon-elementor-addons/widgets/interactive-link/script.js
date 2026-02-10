!(function ($) {

    'use strict';

    function interactiveLinkSlider($Scope, $){

        var myData = $Scope.find('.interactive-link-slider-wrapper').data('slider-settings'),
            galleryTop = $Scope.find('.gallery-top'),
            galleryThumbs = $Scope.find('.gallery-thumbs'),
            next = $Scope.find('.next-ctrl'),
            prev = $Scope.find('.prev-ctrl');
        
        var myThumbs = new Swiper(galleryThumbs, {
            slidesPerView: 1,
            speed: myData.speed,
            loop: false,
            mousewheel: myData.mousewheel,
            autoplay: myData.autoplay,
            spaceBetween: 0,
            observer: true,
            freeMode: false,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            updateOnWindowResize: true,
            simulateTouch: false,
            grabCursor: false,
            on: {
                init: function() {

                    var activeSlide = galleryThumbs.find('.swiper-slide.swiper-slide-active'),
                        inactiveSlide = galleryThumbs.find('.swiper-slide:not(.swiper-slide-active)');

                    if ( $(window).width() > 1024 ) {
                        inactiveSlide.find('.slide-item-footer').slideUp();
                        activeSlide.find('.slide-item-footer').slideDown();
                        
                    } else {
                        galleryThumbs.find('.slide-item-footer').slideDown();
                    }
                },
                slideChange: function () {

                },
                resize: function() {
                    var swiper = this;
                    swiper.update();
                }
            },
            navigation: {
                nextEl: next,
                prevEl: prev,
            },
            breakpoints: {
                320: {
                    slidesPerView: myData.smperview
                },
                768: {
                    slidesPerView: myData.mdperview
                },
                1024: {
                    slidesPerView: myData.perview
                }
            }
        });
        var mySwiper = new Swiper(galleryTop, {
            spaceBetween: 0,
            speed: myData.speed,
            loop: false,
            mousewheel: myData.mousewheel,
            autoplay: myData.autoplay,
            parallax: myData.parallax,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            updateOnWindowResize: true,
            grabCursor: false,
            navigation: {
                nextEl: next,
                prevEl: prev,
            },
            thumbs: {
                swiper: myThumbs
            },
            on: {
                init: function() {

                    var swiper = this;
                    
                    for (var i = 0; i < swiper.slides.length; i++) {
                        $(swiper.slides[i]).find('.bg-cover').attr({
                            'data-swiper-parallax': 0.75 * swiper.width
                        })
                    }
                },
                resize: function() {
                    var swiper = this;
                    swiper.update();
                }
            },
        });
        var hoverItems = function() {
            $Scope.find('.gallery-thumbs .swiper-slide').on('mouseover', function() {
                mySwiper.slideTo($(this).index());
                $(this).find('.slide-item-footer').slideDown().addClass('active');
                $Scope.find('.gallery-thumbs .swiper-slide:not(.swiper-slide-thumb-active) .slide-item-footer').removeClass('active').slideUp();
            });
        }
        var clickItems = function() {
            galleryThumbs.find('.slide-item-footer').slideDown();
        }
        if ( $(window).width() > 1024 ) {
            hoverItems();
        } else {
            clickItems();
        }
        $(window).on('resize', function(){
            mySwiper.update();
            myThumbs.update();
            if ( $(window).width() > 1024 ) {
                
                hoverItems();
            } else {
                clickItems();
            }
        });

    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-interactive-link-slider.default', interactiveLinkSlider);
    });

})(jQuery);
