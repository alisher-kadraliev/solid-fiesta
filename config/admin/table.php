<?php
/**
 * Configuration settings for pagination limits in various templates.
 *
 * @param array table_length Pagination limits for table template
 * @param array cards_length Pagination limits for card template
 * @param array gallery_length Pagination limits for gallery template
 * @param string length_menu_DataTables Pagination limits for table (dataTable) in JS format
 */
return [
    'table_length'           => [10 => 10, 50 => 50, 100 => 100, 9999 => "All"],
    'cards_length'           => [12 => 12, 48 => 48, 96 => 96, 9999 => "All"],
    'gallery_length'         => [28 => 28, 56 => 56, 112 => 112, 9999 => "All"],
    'length_menu_DataTables' => '[[10, 50, 100, -1], [10, 50, 100, "All"]]',
];
