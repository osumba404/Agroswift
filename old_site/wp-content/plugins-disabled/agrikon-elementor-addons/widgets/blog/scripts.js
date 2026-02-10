!(function ($) {

    'use strict';

    /* agrikonBlogSlider */
    function agrikonBlogSlider2( $scope, $ ) {
        $scope.find( '.blog--slider-wrapper' ).each(function () {
            var myData = $(this).data('slider-settings'),
                mySlider = $(this).find('.swiper-container'),
                next = $(this).find('.next-ctrl'),
                prev = $(this).find('.prev-ctrl'),
                scrollbar = $(this).find('.swiper-scrollbar'),
                coverflow = false,
                centered = false,
                myeffect = 'slide';
                
            if ( myData.coverflow === true ) {
                centered = myData.centered;
                myeffect = 'coverflow';
                coverflow = {
                    rotate: myData.rotate,
                    stretch: 0,
                    depth: myData.depth,
                    modifier: 1,
                    slideShadows: false,
                }
            }
            const options = {
                effect: myeffect,
                centeredSlides: centered,
                slidesPerView: 1,
                spaceBetween: myData.gap,
                speed: myData.speed,
                loop: myData.loop,
                mousewheel: myData.mousewheel,
                autoplay: myData.autoplay,
                observer: true,
                freeMode: false,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                updateOnWindowResize: true,
                preventClicksPropagation: true,
                slideToClickedSlide: true,
                grabCursor: true,
                navigation: {
                    nextEl: next,
                    prevEl: prev,
                },
                scrollbar: {
                    el: scrollbar,
                    hide: myData.hidescrollbar,
                },
                coverflowEffect:coverflow,
                breakpoints: {
                    320: {
                        slidesPerView: myData.smperview,
                        spaceBetween: myData.gap,
                        effect: 'slide',
                        coverflowEffect:false,
                        containerModifierClass: 'swiper-mobile-active-'
                    },
                    768: {
                        slidesPerView: myData.mdperview,
                        spaceBetween: myData.gap,
                        containerModifierClass: 'swiper-tablet-active-'
                    },
                    1024: {
                        slidesPerView: myData.perview,
                        spaceBetween: myData.gap,
                        containerModifierClass: 'swiper-desktop-active-'
                    }
                },
                on: {
                    resize: function() {
                        var swiper = this;
                        swiper.updateSlides();
                    },
                }
            };
            // initialize
            const mySwiper = new Swiper(mySlider, options);
            
            if ( myData.autoplay === true && myData.hoverstop === true ) {
                mySlider.hover(function(){
                    mySwiper.autoplay.stop();
                }, function(){
                    mySwiper.autoplay.start();
                });
            }
            
        });
        
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-blog-slider2.default', agrikonBlogSlider2);
    });

})(jQuery);
