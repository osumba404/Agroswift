(function(window, document, $) {

    "use strict";

    function agrikonOdometer($scope,$) {
        $scope.find(".odometer").each(function () {
            var myOdometers = $(this),
                myID = myOdometers.attr('id'),
                myData = myOdometers.data('agrikon-odometer'),
                myTheme = myData.theme,
                myNumber = myData.number,
                myNumber2 = myData.number2,
                myTimeout = myData.timeout,
                myFormat = myData.format,
                myOdometer = document.getElementById(myID),
                od = new Odometer({
                    el: myOdometer,
                    value: myNumber,
                    format: myFormat,
                    theme: myTheme,
                });
        });
        $scope.find(".odometer").appear(function (e) {
            var odo = $scope.find(".odometer");
            odo.each(function () {
                var myData = $(this).data('agrikon-odometer');
                var countNumber = myData.number2;
                $(this).html(countNumber);
            });
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-odometer.default', agrikonOdometer);
    });

})(window, document, jQuery);
