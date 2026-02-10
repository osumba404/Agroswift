!(function ($) {

    // arriavlsSlider
    function arriavlsSlider($scope, $) {

        $scope.find('.wc-flash-deals--slider .thm-swiper__slider').each(function () {
            const options = JSON.parse(this.dataset.swiperOptions);
            let mySwiper = new Swiper(this, options);
        });

        $scope.find('.wc-flash-deals--slider .timer-grid').each(function () {
            const coptions = eval(JSON.parse(this.dataset.countdownOptions));
            $( this ).countdown(coptions);
        });

        $scope.find('.wc-flash-deals--slider-tabbed').each(function () {
            var myWrapper = $( this );

            var myTabs = myWrapper.find('.tab');
            if (myTabs.length) {
                myTabs.each(function (i, el) {
                    var myTab = $(el);
                    var myTabItems = $('.tab_nav .tab_nav_item', myTab);
                    var myTabPages = $('.tab_page', myTab);
                    var myTabToggle = $('.tab_nav_toggle_button', myTab);
                    var myNav = $('.tab_nav', myTab);
                    var myActiveTab = myTabItems.first();
                    if (myTabItems.filter('.is-active').length) {
                        myActiveTab = myTabItems.filter('.is-active').first();
                    }
                    var myActiveTabId = myActiveTab.data('id');
                    myTabItems.filter('[data-id="'+ myActiveTabId +'"]').addClass('is-active');
                    myTabPages.filter('[data-id="'+ myActiveTabId +'"]').addClass('is-active');
                    myTabItems.on('click', function (e) {
                        e.preventDefault();
                        var self = $(this);
                        var selfId = self.data('id');
                        myTabItems.removeClass('is-active');
                        myTabPages.removeClass('is-active');
                        self.addClass('is-active');
                        myTabPages.filter('[data-id="'+ selfId +'"]').addClass('is-active');
                        if(myNav.hasClass('is-active')){
                            myNav.removeClass('is-active');
                        }
                    });

                    myTabToggle.on('click', function (e) {
                        if(myNav.hasClass('is-active')){
                            myNav.removeClass('is-active');
                        } else {
                            myNav.addClass('is-active');
                        }
                    });
                });
            }
        });

        $scope.find('.wc-flash-deals--slider-tabbed .thm-swiper__slider').each(function (el,i) {
            var id = $(this).attr('id');
            let mySwiper2 = new Swiper('#'+id, JSON.parse(this.dataset.swiperOptions));
        });

    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-woo-flash-deals.default', arriavlsSlider);
    });

})(jQuery);
