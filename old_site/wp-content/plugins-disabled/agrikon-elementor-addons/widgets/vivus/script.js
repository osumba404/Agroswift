(function(window, document, $) {

    "use strict";

    function svgAnimation($scope,$) {

        var controller = new ScrollMagic.Controller();

        var myElement = $scope.find('.infographic-icon');
        var mySvgId = myElement.attr('id');
        var myData = myElement.data('svg-settings');
        var mySvg = myData.svg;
        var myDuration = myData.duration;
        var myStroke = myData.stroke;
        var myStrokeWidth = myData.stroke_width;
        var myFill = myData.fill;
        var myPlayOnce = myData.playonce;
        var myReverse = myData.reverse;
        var myStart = myPlayOnce == true ? 'inViewport' : 'autostart';

        var myVivus = new Vivus(mySvgId,
            {
                file: mySvg,
                duration: myDuration,
                start: myStart,
                type: 'sync',
                onReady: function (myEl) {
                    myEl.el.classList.add('infographic-svg');
                    myEl.el.setAttribute('id', 'svg-'+mySvgId );
                    if ( myStroke ) {
                        myEl.el.setAttribute('stroke', myStroke );
                    }
                    if ( myStrokeWidth ) {
                        myEl.el.setAttribute('stroke-width', myStrokeWidth );
                    }
                    if ( myFill ) {
                        myEl.el.setAttribute('fill', myFill );
                    }
                }
            },
            function (myEl) {
                myEl.el.classList.add('finished');
            }
        );

        if ( myPlayOnce == false ) {
            new ScrollMagic.Scene({
                triggerElement: "#"+ mySvgId,
                duration: "100%",
                reverse: myReverse,
                triggerHook: 1
            }).on('enter', function () {

                var container = this.triggerElement();

                $(container).find('.infographic-svg').each(function () {
                    myVivus.reset().play();
                });

            }).on('leave', function() {
                var container = this.triggerElement();
                $(container).find('.infographic-svg').each(function () {
                    $(this).removeClass('finished');
                });
            }).addTo(controller);
            
        } else {
            myVivus.reset().play();
        }

    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-svg-animation.default', svgAnimation);
    });

})(window, document, jQuery);
