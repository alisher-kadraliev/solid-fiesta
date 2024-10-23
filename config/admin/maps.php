<?php
/**
 * Configuration settings for maps.
 *
 * @param string bing_map_api_key API key for Bing Maps
 * @param string google_map_api_key API key for Google Maps
 * @param int map_start_zoom Starting zoom level for maps
 * @param float map_star_latitude Default latitude for map markers
 * @param float map_star_longitude Default longitude for map markers
 */

return [
    'bing_map_api_key'   => env('BING_MAP_KEY', false),
    'google_map_api_key' => env('GOOGLE_MAP_KEY', false),
    'map_start_zoom'     => 13,
    'map_star_latitude'  => 40.70290175364676,
    'map_star_longitude' => -74.01507115297852,
];
