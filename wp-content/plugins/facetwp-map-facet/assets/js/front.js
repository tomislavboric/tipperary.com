var FWP_MAP = FWP_MAP || {};

(function($) {

    FWP_MAP.markersArray = [];
    FWP_MAP.markerLookup = {};
    FWP_MAP.is_filtering = false;

    // Get markers for a given post ID
    FWP_MAP.get_post_markers = function(post_id) {
        var output = [];
        if ('undefined' !== typeof FWP_MAP.markerLookup[post_id]) {
            var arrayOfIndexes = FWP_MAP.markerLookup[post_id];
            for (var i = 0; i < arrayOfIndexes.length; i++) {
                var index = FWP_MAP.markerLookup[post_id][i];
                output.push(FWP_MAP.markersArray[index]);
            }
        }
        return output;
    }

    FWP.hooks.addAction('facetwp/refresh/map', function($this, facet_name) {
        var selected_values = [];

        if (FWP_MAP.is_filtering) {
            selected_values = FWP_MAP.map.getBounds().toUrlValue().split(',');
        }

        FWP.facets[facet_name] = selected_values;
        FWP.frozen_facets[facet_name] = 'hard';
    });

    FWP.hooks.addAction('facetwp/reset', function() {
        $.each(FWP.facet_type, function(name, type) {
            if ('map' === type) {
                FWP.frozen_facets[name] = 'hard';
            }
        });
    });

    FWP.hooks.addFilter('facetwp/selections/map', function(label, params) {
        return FWP_JSON['map']['resetText'];
    });

    function do_refresh() {
        if (FWP_MAP.is_filtering) {
            FWP.autoload();
        }
    }

    $(document).on('click', '.facetwp-map-filtering', function() {
        var $this = $(this);

        if ($this.hasClass('enabled')) {
            $this.text(FWP_JSON['map']['filterText']);
            FWP_MAP.is_filtering = false;
            FWP.autoload();
        }
        else {
            $this.text(FWP_JSON['map']['resetText']);
            FWP_MAP.is_filtering = true;
        }

        $this.toggleClass('enabled');
    });

    $(document).on('facetwp-loaded', function() {
        if ('undefined' === typeof FWP.settings.map || '' === FWP.settings.map) {
            return;
        }

        if (! FWP.loaded) {

            FWP_MAP.map = new google.maps.Map(document.getElementById('facetwp-map'), FWP.settings.map.init);
            FWP_MAP.infoWindow = new google.maps.InfoWindow();

            FWP_MAP.map.addListener('dragend', function() {
                do_refresh();
            });

            FWP_MAP.map.addListener('zoom_changed', function() {
                do_refresh();
            });

            google.maps.event.addDomListener(window, 'resize', function() {
                var center = FWP_MAP.map.getCenter();
                google.maps.event.trigger(FWP_MAP.map, 'resize');
                FWP_MAP.map.setCenter(center);
            });

            google.maps.event.addListener(FWP_MAP.map, 'click', function() {
                FWP_MAP.infoWindow.close();
            });

            FWP_MAP.oms = new OverlappingMarkerSpiderfier(FWP_MAP.map, {
                markersWontMove: true,
                markersWontHide: true,
                basicFormatEvents: true
            });
        }
        else {
            clearOverlays();
        }

        // this needs to re-init on each refresh
        FWP_MAP.bounds = new google.maps.LatLngBounds();

        $.each(FWP.settings.map.locations, function(idx, obj) {
            var args = $.extend({
                map: FWP_MAP.map,
                position: obj.position,
                content: obj.content,
                post_id: obj.post_id
            }, obj);

            var marker = new google.maps.Marker(args);

            google.maps.event.addListener(marker, 'spider_click', function() {
                FWP_MAP.infoWindow.setContent(marker.content);
                FWP_MAP.infoWindow.open(FWP_MAP.map, marker);

                // Custom click handler
                FWP.hooks.doAction('facetwp_map/marker/click', marker);
            });

            // Custom mouseover handler
            google.maps.event.addListener(marker, 'mouseover', function() {
                FWP.hooks.doAction('facetwp_map/marker/mouseover', marker);
            });

            // Custom mouseout handler
            google.maps.event.addListener(marker, 'mouseout', function() {
                FWP.hooks.doAction('facetwp_map/marker/mouseout', marker);
            });

            FWP_MAP.oms.addMarker(marker);
            FWP_MAP.markersArray.push(marker);
            FWP_MAP.bounds.extend(marker.getPosition());

            // Create an object to lookup markers based on post ID
            if ( 'undefined' !== typeof FWP_MAP.markerLookup[obj.post_id]) {
                FWP_MAP.markerLookup[obj.post_id].push(idx);
            }
            else {
                FWP_MAP.markerLookup[obj.post_id] = [idx];
            }
        });

        var config = FWP.settings.map.config;

        if ('yes' === config.cluster) {
            FWP_MAP.mc = new MarkerClusterer(FWP_MAP.map, FWP_MAP.markersArray, {
                imagePath: FWP.settings.map.imagePath,
                imageExtension: FWP.settings.map.imageExtension,
                maxZoom: 14
            });
        }

        if (! FWP_MAP.is_filtering && 0 < FWP.settings.map.locations.length) {
            FWP_MAP.map.fitBounds(FWP_MAP.bounds);
        }
        else if (0 < config.default_lat && 0 < config.default_lng) {
            FWP_MAP.map.setCenter({
                lat: parseFloat(config.default_lat),
                lng: parseFloat(config.default_lng)
            });
        }
    });

    // Clear markers
    function clearOverlays() {
        FWP_MAP.oms.removeAllMarkers();
        FWP_MAP.markersArray = [];
        FWP_MAP.markerLookup = {};

        // clear clusters
        if ('undefined' !== typeof FWP_MAP.mc) {
            FWP_MAP.mc.clearMarkers();
        }
    }

})(jQuery);
