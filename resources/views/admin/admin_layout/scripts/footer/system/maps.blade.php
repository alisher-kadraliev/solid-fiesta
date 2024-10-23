@if(config('admin.maps.google_map_api_key') || config('admin.maps.bing_map_api_key'))
    <script>
        let mapStartZoom = {{config('admin.maps.map_start_zoom')}};
        let mapStarLatitude = {{config('admin.maps.map_star_latitude')}};
        let mapStarLongitude = {{config('admin.maps.map_star_longitude')}};
    </script>
    @if(config('admin.maps.google_map_api_key'))
        <script>
            window.initGoogleMap = function () {
                window.initGoogleMap = null;
                mapsStart.set_google_map();
            };
        </script>
        <script src="//maps.googleapis.com/maps/api/js?key={{config('admin.maps.google_map_api_key')}}&callback=initGoogleMap" defer></script>
    @endIf
    @if(config('admin.maps.bing_map_api_key'))
        <script>
            let bingKey = "{{config('admin.maps.bing_map_api_key')}}";
            window.initBingMap = function () {
                window.initBingMap = null;
                mapsStart.set_bing_map();
            };
        </script>
        <script type='text/javascript' src='//www.bing.com/api/maps/mapcontrol?callback=initBingMap' async defer></script>
    @endIf
@endIf
