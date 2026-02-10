(function(window, document, $) {

    "use strict";

    function agrikonButton($scope,$) {
        $scope.find('.nt-btn-6').on('mouseenter', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
        })
        .on('mouseout', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-button2.default', agrikonButton);
    });

})(window, document, jQuery);
