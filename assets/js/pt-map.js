jQuery(window).on('elementor/frontend/init',function(){
	elementorFrontend.hooks.addAction('frontend/element_ready/pt-map.default',function($scope,$){
        var mapElement = $scope.find('.pt_maps_map_height');
        var mapSettings = mapElement.data('settings');
        var mapStyle = mapElement.data('style');
        premiumMap = newMap(mapElement,mapSettings,mapStyle);
        function newMap(map,settings,mapStyle){
            var scrollwheel = JSON.parse(settings['scrollwheel']);
            var streetViewControl = JSON.parse(settings['streetViewControl']);
            var fullscreenControl = JSON.parse(settings['fullScreen']);
            var zoomControl = JSON.parse(settings['zoomControl']);
            var mapTypeControl = JSON.parse(settings['typeControl']);
            var centerLat = JSON.parse(settings['centerlat']);
            var centerLong = JSON.parse(settings['centerlong']);
            var autoOpen = JSON.parse(settings['automaticOpen']);
            var hoverOpen = JSON.parse(settings['hoverOpen']);
            var hoverClose = JSON.parse(settings['hoverClose']);
            var args = {
                zoom: settings['zoom'],
                mapTypeId: settings['maptype'],
                center: {lat: centerLat, lng: centerLong},
                scrollwheel: scrollwheel,
                streetViewControl: streetViewControl,
                fullscreenControl: fullscreenControl,
                zoomControl: zoomControl,
                mapTypeControl: mapTypeControl,
                styles: mapStyle
            };
            var markers = map.find(".pt-pin");
            var map = new google.maps.Map( map[0], args);
            map.markers = [];
            // add markers
            markers.each(function(){
                add_marker( jQuery(this), map, autoOpen, hoverOpen, hoverClose );
            });
            return map;
        }
        function add_marker( pin, map ,autoOpen, hoverOpen, hoverClose ) {
            var latlng = new google.maps.LatLng( pin.attr('data-lat'), pin.attr('data-lng') );

            icon_img = pin.attr('data-icon');
            if(icon_img != ''){
                var icon = {
                    url : pin.attr('data-icon')
                };
            }

            // create marker
            var marker = new google.maps.Marker({
                position	: latlng,
                map			: map,
                icon        : icon
            });

            // add to array
            map.markers.push( marker );

            // if marker contains HTML, add it to an infoWindow

            if( pin.find('.pt-maps-info-title').html() || pin.find('.pt-maps-info-desc').html() )
            {
                // create info window
                var infowindow = new google.maps.InfoWindow({
                    content		: pin.html()
                });
                if(autoOpen){
                    infowindow.open( map, marker );
                }
                if(hoverOpen){
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infowindow.open( map, marker );
                    });
                    if(hoverClose){
                        google.maps.event.addListener(marker, 'mouseout', function() {
                            infowindow.close( map, marker );
                        });
                    }
                }
                // show info window when marker is clicked
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open( map, marker );
                });
            }
        }
    });
});