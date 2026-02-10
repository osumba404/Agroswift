!(function ($) {

    'use strict';

    function ntrMegaMenu($Scope, $){

        $('body').addClass('nt-has-mega-menu');

        var win = $(window).width();
        var mobile = $Scope.find('.nt-header').data('breakpoint');

        $Scope.find( '.nt-header' ).closest('.elementor-top-section').addClass("has-big-index");

        if ( win <= mobile ) {
            $Scope.find('.nt-header').addClass('nt-mobile').removeClass('nt-desktop');
        }

        $Scope.find('.nt-header.nt-desktop .content-wrapper').each( function(){
            var cont = $( this ),
                parent = cont.parent('li'),
                parentpos = parent.position(),
                parentoff = parent.offset();
                parentoff = 100 * parentoff.left / window.innerWidth;
                if ( $('.nt-desktop').length ) {
                    cont.css('margin-left','-'+parentoff+'vw');
                } else {
                    cont.css('margin-left','0');
                }
        });
        if ( $('.nt-mobile').length ) {
            var mobcont = $Scope.find('.nt-header.nt-mobile .hamburger-wrapper'),
                mobparentoff = mobcont.offset();
                console.log(mobparentoff.left);
                mobparentoff = 100 * mobparentoff.left / window.innerWidth;
                
            $Scope.find('.nt-header.nt-mobile .nt-navbar-primary').css('margin-left', '-'+mobparentoff+'vw');
        }

        $(window).resize(function(){
            var win = $(window).width();

            if ( win <= mobile ){
                $Scope.find('.nt-header').removeClass('nt-desktop');
                $Scope.find('.nt-header').addClass('nt-mobile');
                $Scope.find('.nt-header .content-wrapper').each( function(){
                    var cont = $( this );
                    cont.css('margin-left','0');
                });
            } else  {
                $Scope.find('.nt-header').addClass('nt-desktop');
                $Scope.find('.nt-header').removeClass('nt-mobile');
                $Scope.find('.nt-header .hamburger').removeClass( "is-active" );
                $Scope.find('.nt-header .hamburger').next().removeAttr( 'style' ).removeClass( "show" );
                $Scope.find('.nt-header .show').removeClass( "show" );
                $Scope.find('.nt-header .container-wrapper').removeAttr( 'style' );
                $Scope.find('.nt-header .content-wrapper').removeAttr( 'style' );
                $Scope.find('.nt-header .nt-navbar-primary').removeAttr( 'style' );
                $Scope.find('.nt-header .sub-menu').removeAttr( 'style' );

                $Scope.find('.nt-header .content-wrapper').each( function(){
                    var cont = $( this ),
                        parent = cont.parent('li'),
                        parentoff = parent.offset();
                        parentoff = 100 * parentoff.left / window.innerWidth;
                    cont.css('margin-left','-'+parentoff+'vw');
                });
            }

        });

        // =================
        $Scope.find('.nt-header .hamburger').on('click', function (e) {
            e.preventDefault();
            let $this = $( this );
            let nextBtn = $this.parent().next();

            $this.toggleClass( "is-active" );

            if ( $Scope.find('.nt-header').hasClass( 'nt-mobile' ) ) {
                if ( nextBtn.hasClass( 'show' ) ) {
                    nextBtn.slideUp(350);
                    setTimeout(function(){
                        nextBtn.removeClass( 'show' );
                    }, 350);
                    nextBtn.find( '.content-wrapper' ).slideUp( 350 );
                    nextBtn.find( '.container-wrapper' ).slideUp( 350 );
                    nextBtn.find( '.sub-menu.row .sub-menu' ).slideUp( 350 );
                    nextBtn.find( '.vertical-menu .sub-menu' ).slideUp( 350 );
                    nextBtn.find( '.show' ).removeClass( 'show' );
                } else {
                    nextBtn.addClass( 'show' ).show();
                }
            } else {
                nextBtn.removeAttr( 'style' );
                $this.toggleClass( "is-active" );
            }
        });


        // =================
        $Scope.find( '.nt-header .nt-primary-list > .primary-item > a' ).on('click', function(e) {
            e.preventDefault();
            let $this = $( this) ;

            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-mobile' ) ) {
                if ( $this.parent().hasClass( 'show' ) ) {
                    $this.next().slideUp(350);
                    setTimeout(function(){
                        $this.parent().removeClass( 'show' );
                    }, 350);
                } else {

                    $this.parent().parent().find( '.content-wrapper' ).slideUp( 350 );
                    $this.parent().parent().find( '.container-wrapper' ).slideUp( 350 );
                    $this.parent().parent().find( '.vertical-menu .sub-menu' ).slideUp( 350 );
                    $this.parent().parent('.row').find( '.sub-menu' ).slideUp( 350 );
                    $this.parent().parent().find( '.show' ).removeClass( 'show' );
                    $this.next().slideDown( 350 );
                    $this.parent().addClass( 'show' );
                }
            }
        });

        $Scope.find( '.nt-header .vertical-menu .sub-menu > li.menu-item-has-children > a' ).click( function(e) {
            e.preventDefault();
            let $this = $( this) ;
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-mobile' ) ) {
                if ( $this.parent().hasClass( 'show' ) ) {
                    $this.next().slideUp(350);

                    setTimeout(function(){
                        $this.parent().removeClass( 'show' );
                    }, 350);

                } else {

                    $this.parent().parent().find( '.show' ).removeClass( 'show' );
                    $this.parent().parent().find( '.sub-menu' ).slideUp( 350 );
                    $this.next().slideDown( 350 );
                    $this.parent().addClass( 'show' );
                }
            }
        });

        $Scope.find( '.nt-header .container .sub-menu > li.menu-item-has-children > a' ).click( function(e) {
            e.preventDefault();
            let $this = $( this) ;
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-mobile' ) ) {
                if ( $this.parent().hasClass( 'show' ) ) {
                    $this.next().slideUp( 350 );
                    $this.parent().removeClass( 'show' );

                } else {

                    $this.parent().parent().find( '.show' ).removeClass( 'show' );
                    $this.parent().parent().find( '.sub-menu' ).slideUp( 350 );
                    $this.next().slideDown( 350 );
                    $this.parent().addClass( 'show' );
                }
            }
        });

        $Scope.find( '.nt-desktop .container.column-action-click .sub-menu > li.menu-item-has-children > a' ).click( function(e) {
            e.preventDefault();
            let $this = $( this) ;
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-desktop' ) ) {
                if ( $this.parent().hasClass( 'show' ) ) {
                    $this.next().slideUp( 350 );
                    $this.parent().removeClass( 'show' );

                } else {

                    $this.parent().parent().find( '.show' ).removeClass( 'show' );
                    $this.parent().parent().find( '.sub-menu' ).slideUp( 350 );
                    $this.next().slideDown( 350 );
                    $this.parent().addClass( 'show' );
                }
            }
        });


        // =================
         $Scope.find('.nt-header.nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper.has-opac >.container').hover(function(){
             if ( $Scope.find( '.nt-header' ).hasClass( 'nt-desktop' ) ) {
                 $(this).addClass("shadow-none");
             }
        }, function(){
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-desktop' ) ) {
                $(this).removeClass("shadow-none");
            }
        });
         $Scope.find('.nt-header.nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper.has-opac .sub-menu.row > li.menu-item-has-children').hover(function(){
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-desktop' ) ) {
                $(this).addClass("has-shadow");
                $(this).siblings().addClass("opac");
            }
        }, function(){
            if ( $Scope.find( '.nt-header' ).hasClass( 'nt-desktop' ) ) {
                $(this).removeClass("has-shadow");
                $(this).siblings().removeClass("opac");
            }
        });

        /* scroll top
    	================================================== */
		$(window).scroll(function() {

			var has_sticky = $Scope.find('.nt-header.is-sticky-header');
			var scroll = $(window).scrollTop();

			if ( has_sticky.length ) {
				if ( scroll > 0 ) {
					$Scope.find( '.nt-header' ).closest('.elementor-top-section').addClass("is-section-sticked");
				} else {
					$Scope.find( '.nt-header' ).closest('.elementor-top-section').removeClass("is-section-sticked");
				}
			}

		});


    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-mega-menu.default', ntrMegaMenu);
    });

})(jQuery);
