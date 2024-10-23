<?php
/**
 * Parameters used to fill JavaScript for calendar date picker in footer/scripts.blade.php
 * Please visit https://flatpickr.js.org/ for documentation on the date time picker plugin.
 *
 * @var string $locale JSON encoded string that represents the configuration options for the plugin's localization.
 * @var string $rangeSeparator separator inside blade file for date range picker. Please keep it the same as in locale.rangeSeparator
 */
return [
    'locale' => '{
                weekdays: {
                    shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    longhand: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                },
                months: {
                    shorthand: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    longhand: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                },
                firstDayOfWeek: 1,
                weekAbbreviation: "Sun.",
                rangeSeparator: " - ",
                time_24hr: true,
                show_months: 1,
                enableSeconds: false,
            }',
    'rangeSeparator' =>  " - ",
];
