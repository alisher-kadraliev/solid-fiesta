/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkMaps {
    constructor() {
    }
    set_google_map() {
        let self = this;
        $(".js-ak-google-map").each(function () {
            self.google_map_start($(this));
        })
    }

    google_map_start(element) {
        let coordinates = '';
        let latitude = element.find('.js-ak-latitude').val();
        let longitude = element.find('.js-ak-longitude').val();

        if (latitude === '' || longitude === '') {
            coordinates = new google.maps.LatLng(mapStarLatitude, mapStarLongitude);
        } else {
            coordinates = new google.maps.LatLng(latitude, longitude);
        }
        let map = new google.maps.Map(
            element.find('.js-ak-map-container')[0],
            {
                zoom: mapStartZoom,
                center: coordinates,
                draggable: true,
            }
        );
        let marker = new google.maps.Marker({
            map: map,
            position: coordinates,
            draggable: true
        });
        google.maps.event.addListener(marker, 'drag', function (event) {
            element.find('.js-ak-latitude').val(event.latLng.lat());
            element.find('.js-ak-longitude').val(event.latLng.lng());
        });
    }

    set_bing_map() {
        let self = this;
        $(".js-ak-bing-map").each(function () {
            self.bing_map_start($(this));
        })
    }

    bing_map_start(element) {
        let latitude = element.find('.js-ak-latitude').val();
        let longitude = element.find('.js-ak-longitude').val();
        if (latitude === '' || longitude === '') {
            latitude = mapStarLatitude;
            longitude = mapStarLongitude;
        }

        let map = new Microsoft.Maps.Map(element.find('.js-ak-map-container')[0], {
            credentials: bingKey,
            center: new Microsoft.Maps.Location(latitude, longitude),
            zoom: mapStartZoom
        });
        //Create custom Pushpin
        let pin = new Microsoft.Maps.Pushpin(map.getCenter(), {
            draggable: true,
            color: '#00f'
        });
        //Add the pushpin to the map
        map.entities.push(pin);
        // Binding the events for the pin
        Microsoft.Maps.Events.addHandler(pin, 'dragend', function () {
            element.find('.js-ak-latitude').val(pin.getLocation().latitude);
            element.find('.js-ak-longitude').val(pin.getLocation().longitude);

        });
    }
}
