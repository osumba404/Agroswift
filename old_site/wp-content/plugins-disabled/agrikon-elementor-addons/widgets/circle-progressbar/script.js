(function(window, document, $) {

    "use strict";

    function agrikonCircleProgresbar($scope,$) {
        $scope.find(".circle--progressbar").appear(function () {
            $scope.find(".circle--progressbar").each(function () {
                let myCircle = $(this);
                let progressOptions = myCircle.data("options");
                let myType = myCircle.data('type');
                let add = { startAngle: -Math.PI/2 };
                Object.entries(add).forEach(([key,value]) => { progressOptions[key] = value });
                console.log(myType);
                if ( myType === 'counter' ) {
                    myCircle.circleProgress(progressOptions).on('circle-animation-progress', function(event, progress, stepValue) {
                        $(this).find('strong').html(Math.round(100 * stepValue) + '<i>%</i>');
                    });
                } else if ( myType === 'counter2' ) {
                    myCircle.circleProgress(progressOptions).on('circle-animation-progress', function(event, progress, stepValue) {
                        $(this).find('strong').text(stepValue.toFixed(2).substr(1));
                    });
                } else if ( myType === 'counter3' ) {
                    myCircle.circleProgress(progressOptions).on('circle-animation-progress', function(event, progress, stepValue) {
                        $(this).find('strong').html(Math.round(100 * stepValue) + '<i>%</i>');
                    });
                } else {
                    myCircle.circleProgress(progressOptions);
                }
            });
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-circle-progresbar.default', agrikonCircleProgresbar);
    });

})(window, document, jQuery);
