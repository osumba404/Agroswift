/*-----------------------------------------------------------------------------------

    Theme Name: Agrikon
    Description: Creative Agency & Portfolio WordPress Theme
    Author: Ninetheme
    Author URI: https://ninetheme.com/
    Version: 1.0

-----------------------------------------------------------------------------------*/


(function(window, document, $) {

    "use strict";


    function agrikonLocomotiveAnim() {
        $( '[data-scroll-class]' ).each(function () {
            $( this ).addClass('animated');
        });
    }
    function agrikonLocomotiveRemoveAnim() {
        $( '[data-element_type="widget"]' ).each(function () {
            $( this ).find('.fadeIn').removeClass('fadeIn');
            $( this ).find('.wow').removeClass('wow').removeAttr('style');
        });
    }
    function locoParallaxImage() {
        $( '[data-scroll-call="locoParallaxImage"]' ).each(function () {

            var myEl = $( this ),
                containerEl = myEl.find('.elementor-widget-container'),
                containerNext = myEl.find('.elementor-image'),
                call = myEl.data('scroll-call'),
                speed = myEl.data('scroll-speed'),
                direction = myEl.data('scroll-direction');
                if ( speed == '2' ){
                    speed = '-1';
                } else if ( speed == '3' ){
                    speed = '-1.25';
                } else if ( speed == '4' ){
                    speed = '-1.5';
                } else if ( speed == '5' ){
                    speed = '-1.75';
                } else if ( speed == '6' ){
                    speed = '-2';
                } else {
                    speed = '';
                }
            containerEl.attr({
                "data-scroll": '',
                "style": "overflow:hidden;"

            });
            containerNext.attr({
                "data-scroll": '',
                "data-scroll-speed": speed,
                "data-scroll-direction": direction

            });
        });
    }

    $(document).ready(function() {
        agrikonLocomotiveRemoveAnim();
        agrikonLocomotiveAnim();
        locoParallaxImage();

    });


    $.fn.countTo = function(options) {
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        var loops = Math.ceil(options.speed / options.refreshInterval),
        increment = (options.from - options.to) / loops;
        Number.prototype.formatMoney = function(c, d, t){
            var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };

        return $(this).each(function() {
            var _this = this,
            loopCount = 0,
            value = options.from,
            interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value -= increment;
                loopCount++;
                var newVal = value.formatMoney(options.decimals, options.separator);
                $(_this).html(newVal);

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 100,
        to: 10,
        speed: 500,
        refreshInterval: 100,
        decimals: 0,
        onUpdate: null,
        onComplete: null,
        separator: '.'
    };

    function locoProgressBar(i) {
        var myProgress = $( i.target ).find('.elementor-progress-bar'),
            width = myProgress.data('max');
        if ( !width ) {
            return;
        }
        if ( i.repeat === true ) {
            if ( i.inView === true ) {
                myProgress.css('width',width+'%');
            } else {
                myProgress.css('width',0);
            }
        } else {
            myProgress.css('width',width+'%');
        }
    }

    function locoOdometer(i) {
        var myOdometers = $( i.target ).find('.odometer');

        if ( !myOdometers ) {
            return;
        }

        var myID = myOdometers.attr('id'),
            myData = myOdometers.data('agrikon-odometer'),
            myTheme = myData.theme,
            myNumber = myData.number,
            myNumber2 = myData.number2,
            myFormat = myData.format,
            myOdometer = document.getElementById(myID);

        myOdometers.removeAttr('style');


        var od = new Odometer({
            el: myOdometer,
            value: myNumber,
            format: myFormat,
            theme: myTheme
        });

        if ( i.repeat === true ) {

            if ( i.inView === true ) {
                od.update(myNumber2);
            } else {
                od.update(myNumber);
            }

        } else {
            od.update(myNumber2);
        }
    }
    function locoCounterUp(i) {
        var counterEl = $( i.target ).find('.elementor-counter-number'),
            from = counterEl.data('from-value'),
            to = counterEl.data('to-value'),
            delimiter = counterEl.data('delimiter'),
            delimit = ' ' == delimiter ? '.' : delimiter,
            duration = counterEl.data('duration');

        if ( !counterEl || !to ) {
            return;
        }

        var counter = function(){
            counterEl.countTo({
                from: from,
                to: to,
                decimals: 2,// default: 0
                separator:delimit,
                speed: duration
            });

        }
        if ( i.repeat === true ) {
            if ( i.inView === true ) {
                counter();
            } else {
                counterEl.text(from);
            }
        } else {
            counter();
        }
    }


    var scroll = new LocomotiveScroll();
    var myLocoWrapper = document.querySelector('.nt-locomotive-wrapper .elementor:not(.elementor-edit-mode) .elementor-section-wrap');
    if( myLocoWrapper ) {
        myLocoWrapper.setAttribute("data-scroll-container", "");
        scroll = new LocomotiveScroll({
            el: myLocoWrapper,
            smooth: true,
            getDirection: true,
            lerp: 0.05,
        });
    }

    // === window When Loading === //
    $(window).on("load", function () {

        setTimeout(function() {

            $(".c-scrollbar").remove(),
            scroll.destroy(),
            scroll.init(),
            scroll.on('call', function(f,e,i) {
                // f = callback function
                // e = enter element in viewport
                // i = my element

                if ( f === 'locoProgressBar' ) {
                    locoProgressBar(i);
                }
                if ( f === 'locoCounterUp' ) {
                   locoCounterUp(i)
                }
                if ( f === 'locoOdometer' ) {
                   locoOdometer(i)
                }
            }),
            scroll.on('scroll', function(t) {
                var scrollDirection = t.direction;
                var positionBar = scroll.scroll.instance.scroll.y;
                if (positionBar > 0) {
                    $(".overlaynav").addClass("nav-scroll");
                    if ( 'down' == scrollDirection ) {
                        $(".overlaynav").css({
                            top : '-100%',
                            transition : 'top 1s ease-in-out'
                        });
                    } else {
                        $(".overlaynav").css({
                            top : '',
                            transition : 'top 0.5s ease-in-out'
                        });
                    }
                } else {
                    $(".overlaynav").removeClass("nav-scroll");
                }

                var myFixedSection = $('.agrikon-section-fixed-yes');
                var myFixedWrapper = myFixedSection.parents('[data-elementor-type="section"]');
                if ( myFixedSection.length ) {
                    if (positionBar > 0) {
                        myFixedWrapper.addClass( 'section-fixed-active' );
                        if ( 'down' == scrollDirection ) {
                            myFixedWrapper.css({
                                top : '-100%',
                                transition : 'top 1s ease-in-out'
                            });
                        } else {
                            myFixedWrapper.css({
                                top : '',
                                transition : 'top 0.5s ease-in-out'
                            });
                        }
                    } else {
                        myFixedWrapper.removeClass( 'section-fixed-active' );
                    }
                }
            }),
            scroll.update();

        }, 50);

    });

})(window, document, jQuery);
