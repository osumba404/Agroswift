( function ($) {

    "use strict";

    // remove ads on theme options panel
    jQuery( window ).on('load', function() {
        jQuery('#redux-header .rAds').hide();
    });

    /*----------------------------------------------------------------------------------*/
    /*	displaying page custom color
    /*----------------------------------------------------------------------------------*/
    jQuery( document ).ready( function($) {

        var badgestyle = $('#agrikon_badge');
        var badgecustom = $('.agrikon_custom_badge_field');

        badgestyle.val() == 'custom' ? badgecustom.slideDown() : badgecustom.slideUp();

        badgestyle.on('change', function(){
            badgestyle.val() == 'custom' ? badgecustom.slideDown() : badgecustom.slideUp();
        });

    });

})(jQuery);
