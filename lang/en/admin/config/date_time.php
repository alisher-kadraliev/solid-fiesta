<?php
/**
 * Provides the date and time formats for the calendar date picker in the footer/scripts.blade.php file.
 * @var string $php_date_format PHP format for dates (Year-Month-Day).
 * @var string $php_date_time_format PHP format for dates and times (Year-Month-Day Hour:Minute:Second).
 * @var string $php_time_format PHP format for times (Hour:Minute).
 * @var string $js_date_format JavaScript format for dates (Month Day, Year), used for the front-end calendar picker.
 * @var string $php_widget_*** used to format dates on widgets
 **/
return [

    'php_date_format'              => 'F j, Y',
    'php_date_time_format'         => 'F j, Y  H:i:s',
    'php_time_format'              => 'H:i',
    'js_date_format'               => 'F j, Y',
    'js_date_time_format'          => 'F j, Y H:i',
    'js_time_format'               => 'H:i',
    /*widgets date format*/
    'php_widget_full_date_format'  => 'F j, Y',
    'php_widget_short_date_format'  => 'M j, Y',
    'php_widget_full_date_hour_format'  => 'F j, Y H:00',
    'php_widget_month_year_format' => 'M Y',
    'php_long_month_names'         => [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ],
    'php_short_month_names'        => [
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Apr',
        '05' => 'May',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Aug',
        '09' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec',
    ],
];
