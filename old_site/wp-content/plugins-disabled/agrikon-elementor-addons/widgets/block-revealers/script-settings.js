!(function () {
     
    //************************ Example 2 - reveal on scroll ********************************
    function elemReveals($scope, $) {
        
        $scope.find('.agrikon-reveals').each(function () {
            
            var myElement       = $( this );
            
            var myData          = myElement.data( 'reveals-settings' );
            var mytype          = myData.type;
            var mysplittype     = myData.splittype;
            var mybgcolor       = myData.bgcolor;
            var mydirectionin   = myData.directionin;
            var mydirectionout  = myData.directionout;
            var mydelay         = myData.delay;
            var myduration      = myData.duration;
            var mycover         = myData.cover;
            var myscrollbar     = myData.scrollbar;
            
            if ( myElement.length ) {

                if ( 'content' === mytype ) {
                    var myId                = myElement.find('.agrikon-reveal-item').attr('id');
                    var myscrollElemToWatch = document.getElementById( myId );
                    var myWatcher           = scrollMonitor.create(myscrollElemToWatch, -300);

                    var myRev = new RevealFx( myscrollElemToWatch, {
                        revealSettings: {
                            bgcolor: mybgcolor,
                            direction: mydirectionin,
                            delay: mydelay,
                            //coverArea: 50,
                            onCover: function(contentEl, revealerEl) {
                                contentEl.style.opacity = 1;
                            }
                        }
                    });
            
                    myWatcher.enterViewport(function() {
                        myRev.reveal();
                        myWatcher.destroy();
                    });
                }

                if ( 'split' === mytype ) {
                    
                    if ( 'left' === mysplittype ) {
                        
                        var myMediaSplitContent          = myElement.find('.media__toolbar');
                        var myMediaSplitId               = myElement.find('.media__inner').attr('id');
                        var myMediascrollElemToWatch     = document.getElementById( myMediaSplitId );
                        var myMediaSplitWatcher          = scrollMonitor.create(myMediascrollElemToWatch, -300);
                        
                        var myMediaSplitRev = new RevealFx( myMediascrollElemToWatch, {
                            revealSettings: {
                                bgcolor: mybgcolor,
                                duration: myduration,
    							easing: 'easeInOutCirc',
    							directionin: mydirectionin,
    							coverArea: mycover,
                                onCover: function(contentEl, revealerEl) {
                                    contentEl.style.opacity = 1;
                                    $(myMediaSplitContent).addClass('media__toolbar--show');
                                }
                            }
                        });
                
                        myMediaSplitWatcher.enterViewport(function() {
                            myMediaSplitRev.reveal();
                            myMediaSplitWatcher.destroy();
                        });
                        
                    } else {

                        var mySplitContent          = myElement.find('.dual__content');
                        var mySplitId               = myElement.find('.dual__inner').attr('id');
                        var myscrollElemToWatch2    = document.getElementById( mySplitId );
                        var mySplitWatcher          = scrollMonitor.create(myscrollElemToWatch2, -300);
                        
                        var mySplitRev = new RevealFx( myscrollElemToWatch2, {
                            revealSettings: {
                                bgcolor: mybgcolor,
                                duration: myduration,
                                direction: 'rl',
    							easing: 'easeInOutCirc',
    							coverArea: mycover,
                                onCover: function(contentEl, revealerEl) {
                                    contentEl.style.opacity = 1;
                                    $(mySplitContent).addClass('dual__content--show');
                                }
                            }
                        });
                
                        mySplitWatcher.enterViewport(function() {
                            mySplitRev.reveal();
                            mySplitWatcher.destroy();
                        });
                        
                    }
                    
                }
            
                if ( 'modal' === mytype ) {
                    
                    //$('<div class="overlay"></div>').prependTo('body');
                    
                    var myIdd       = myElement.find('.revealers-modal').attr('id');
                    var modalEl     = document.getElementById( myIdd );
                    var revealer    = new RevealFx(modalEl);
                    var closeCtrl   = myElement.find('.btn--modal-close');
                    var closeCtrlTop= myElement.find('.btn--modal-close-top > i');
                
                    myElement.find('.agrikon--modal-open').on('click', function() {
                        $(modalEl).addClass('modal--open');
                        revealer.reveal({
                            bgcolor: mybgcolor,
                            direction: mydirectionin,
                            duration: myduration,
                            easing: 'easeOutCirc',
                            onCover: function(contentEl, revealerEl) {
                                contentEl.style.opacity = 1;
                            },
                            onComplete: function() {
                                
                                if ( closeCtrl ) {
                                    closeCtrl.on('click', function() {
                                        closeModal();
                                    });
                                }
                                
                                closeCtrlTop.on('click', function() {
                                    closeModal();
                                });

                            }
                        });
                    });
                    myElement.find('.modal__inner').overlayScrollbars({
                        className: myscrollbar,
                        scrollbars : {
                            autoHide: "leave",
                            autoHideDelay: 800,
                        }
                    });
                    var closeModal = function (ev) {
                                
                        if ( closeCtrl ) {
                            closeCtrl.on('click', function() {
                                closeModal();
                            });
                        }
                        
                        closeCtrlTop.on('click', function() {
                            closeModal();
                        });
                        
                        $(modalEl).removeClass('modal--open');
                        revealer.reveal({
                            bgcolor: mybgcolor,
                            direction: mydirectionout,
                            duration: myduration,
                            easing: 'easeOutCirc',
                            onCover: function(contentEl, revealerEl) {
                                contentEl.style.opacity = 0;
                            },
                            onComplete: function() {
                                $(modalEl).removeClass('modal--open');
                            }
                        });
                    }
                }
            }
        });
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-block-revealers.default', elemReveals );
    });
})();