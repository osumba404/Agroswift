(function(window, document, $) {

    "use strict";

    function initMap($scope, $) {
        $scope.find('.map').each(function () {

            var myData = $('.map').data('map-settings'),
            myzoom = myData.zoom ? myData.zoom : 12,
            color = myData.mcolors ? myData.mcolors : '#000000',
            tfill = myData.tfill ? myData.tstroke : color,
            tstroke = myData.tstroke ? myData.tfill : color,
            administrative = myData.administrative ? myData.administrative : color,
            landscape = myData.landscape ? myData.landscape : color,
            poi = myData.poi ? myData.poi : color,
            rhighway = myData.rhighway ? myData.rhighway : color,
            rarterial = myData.rarterial ? myData.rarterial : color,
            rlocal = myData.rlocal ? myData.rlocal : color,
            transit = myData.transit ? myData.transit : color,
            water = myData.water ? myData.water : color;
            var map = new google.maps.Map(document.getElementById('ieatmaps'),
            {
                center: {
                    lat: myData.lat,
                    lng: myData.lng
                },
                zoom: myzoom,
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "labels.text.fill",
                        "stylers": [{"saturation": 36},{"color": tfill},{"lightness": 40}]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"visibility": "on"},{"color": tstroke},{"lightness": 16}]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": administrative},{"lightness": 20}]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [{"color": administrative},{"lightness": 17},{"weight": 1.2}]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [{"color": landscape},{"lightness": 20}]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{"color": poi},{"lightness": 21}]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": rhighway},{"lightness": 17}]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"color": rhighway},{"lightness": 29},{"weight": 0.2}]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [{"color": rarterial},{"lightness": 18}]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [{"color": rlocal},{"lightness": 16}]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [{"color": transit},{"lightness": 19}]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{"color": water},{"lightness": 17}]
                    }
                ]
            });

            var marker = new google.maps.Marker(
                {
                    position: new google.maps.LatLng(myData.lat,myData.lng),
                    title: myData.title,
                    map : map
                }
            );
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-map.default', initMap);
    });

})(window, document, jQuery);
