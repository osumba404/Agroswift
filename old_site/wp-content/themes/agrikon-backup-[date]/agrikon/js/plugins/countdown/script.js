jQuery(document).ready(function($) {

    /*-- Strict mode enabled --*/
    'use strict';
    // countdown
    $('.product-timer').each(function () {
        const options = eval(JSON.parse(this.dataset.countdownOptions));
        $( this ).countdown(options);
    });
});
