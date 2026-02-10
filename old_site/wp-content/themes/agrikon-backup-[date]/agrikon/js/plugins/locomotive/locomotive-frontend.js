/*=================================*/
/* Section Parallax
/*=================================*/
!(function ($) {

    var NtLocomotiveHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if ( editMode ) {
            settings = generateEditorSettings( sectionId );
        }

        if ( settings[0] ) {
            generateLocomotive();
        }

        function generateEditorSettings( targetId ) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if ( targetId == elem.id ) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });
            if ( "yes" !== sectionData["agrikon_locomotive_fixedbg"] ) {
                return false;
            }

            settings.push( sectionData["agrikon_locomotive_fixedbg"] );  // settings[0]

            if ( 0 !== settings.length ) {
                return settings;
            }

            return false;
        }


        function generateLocomotive() {

            setTimeout(function() {
                var bgimage = target.css('background-image');
                if ( 'yes' == settings[0] ) {
                    $('<div id="fixed-bg_' + sectionId + '" class="c-fixed_wrapperr" data-scroll><div class="c-fixed_target" id="fixed-target_' + sectionId + '"></div><div class="c-fixed" data-scroll="" data-scroll-sticky data-scroll-target="#fixed-target_' + sectionId + '" style="background-image: url(' + bgimage + ');"></div></div>').prependTo(target);
                } else {
                    $( '#fixed-bg_' + sectionId ).remove();
                }

            }, 500);
        }
    }

    function ntLocomotive() {

        $(".elementor-section[data-agrikon-locomotive-fixedbg]").each(function (i, el) {
            var myLoco= $(el);
            var myLocoId = myLoco.data('id');

            var bgimage = myLoco.css('background-image');
            if ( 'yes' == myLoco.data('agrikon-locomotive-fixedbg') && '' !== bgimage ) {

                $('<div id="fixed-bg_' + myLocoId + '" class="c-fixed_wrapperr" data-scroll><div class="c-fixed_target" id="fixed-target_' + myLocoId + '"></div><div class="c-fixed" data-scroll="" data-scroll-sticky data-scroll-target="#fixed-target_' + myLocoId + '"></div></div>').prependTo(myLoco);
                $( '#fixed-bg_' + myLocoId + ' .c-fixed' ).css('background-image', bgimage);
                myLoco.css('background-image', bgimage);
            } else {
                $( '#fixed-bg_' + myLocoId ).remove();
            }
        });
    }

    jQuery(window).on("elementor/frontend/init", function() {

        ntLocomotive();

    });

})(jQuery);
