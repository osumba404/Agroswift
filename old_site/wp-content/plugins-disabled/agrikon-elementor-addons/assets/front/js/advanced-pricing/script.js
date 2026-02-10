!(function ($) {
	//hide the subtle gradient layer (.agrikon-pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
	
    function ntrAdvancedPricing($scope, $) {
        
        $scope.find('.agrikon-pricing-container').each(function () {
    		var myContainer = $(this);
    		var myBody = myContainer.find('.agrikon-pricing-body');
        	checkScrolling(myBody);
        	$(window).on('resize', function(){
        		window.requestAnimationFrame(function(){checkScrolling(myBody)});
        	});
        	myBody.on('scroll', function(){ 
        		var selected = $(this);
        		window.requestAnimationFrame(function(){checkScrolling(selected)});
        	});
        
        	function checkScrolling(tables){
        		tables.each(function(){
        			var table= $(this),
        				totalTableWidth = parseInt(table.children('.agrikon-pricing-features').width()),
        		 		tableViewport = parseInt(table.width());
        			if( table.scrollLeft() >= totalTableWidth - tableViewport -1 ) {
        				table.parent('li').addClass('is-ended');
        			} else {
        				table.parent('li').removeClass('is-ended');
        			}
        		});
        	}
        
        	//switch from monthly to annual pricing tables
        	bouncy_filter(myContainer);
        
        	function bouncy_filter(container) {
        		container.each(function(){
        			var pricing_table = $(this);
        			var filter_list_container = pricing_table.children('.agrikon-pricing-switcher'),
        				filter_radios = filter_list_container.find('input[type="radio"]'),
        				pricing_table_wrapper = pricing_table.find('.agrikon-pricing-wrapper');
        
        			//store pricing table items
        			var table_elements = {};
        			filter_radios.each(function(){
        				var filter_type = $(this).val();
        				table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="'+filter_type+'"]');
        			});
        
        			//detect input change event
        			filter_radios.on('change', function(event){
        				event.preventDefault();
        				//detect which radio input item was checked
        				var selected_filter = $(event.target).val();
        
        				//give higher z-index to the pricing table items selected by the radio input
        				show_selected_items(table_elements[selected_filter]);
        
        				//rotate each cd-pricing-wrapper 
        				//at the end of the animation hide the not-selected pricing tables and rotate back the .agrikon-pricing-wrapper
        				
        				if( !Modernizr.cssanimations ) {
        					hide_not_selected_items(table_elements, selected_filter);
        					pricing_table_wrapper.removeClass('is-switched');
        				} else {
        					pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {		
        						hide_not_selected_items(table_elements, selected_filter);
        						pricing_table_wrapper.removeClass('is-switched');
        						//change rotation direction if .agrikon-pricing-list has the .agrikon-bounce-invert class
        						if(pricing_table.find('.agrikon-pricing-list').hasClass('cd-bounce-invert')) pricing_table_wrapper.toggleClass('reverse-animation');
        					});
        				}
        			});
        		});
        	}
        	function show_selected_items(selected_elements) {
        		selected_elements.addClass('is-selected');
        	}
        
        	function hide_not_selected_items(table_containers, filter) {
        		$.each(table_containers, function(key, value){
        	  		if ( key != filter ) {	
        				$(this).removeClass('is-visible is-selected').addClass('is-hidden');
        
        			} else {
        				$(this).addClass('is-visible').removeClass('is-hidden is-selected');
        			}
        		});
        	}
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-advanced-pricing.default', ntrAdvancedPricing);
    });

})(jQuery);