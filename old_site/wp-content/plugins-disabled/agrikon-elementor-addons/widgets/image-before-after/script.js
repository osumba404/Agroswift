/*
* Custom Script
*
*/
!(function ($) {
    
    function imgBeforeAfter($scope, $) {
        $scope.find('.nt-images-compare').each(function () {
            
            var myElement = $(this);

            myElement.imagesCompare({
                initVisibleRatio: 0.2,
                interactionMode: "mousemove",
                addSeparator: false,
                addDragHandle: true,
                animationDuration: 450,
                animationEasing: "linear",
                precision: 2
            });
        });
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-image-before-after.default', imgBeforeAfter);
    });
    
})(jQuery);