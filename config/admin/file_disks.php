<?php
/**
 * Configuration settings for file storage disks.
 *
 * @param string driver The name of the driver to be used (e.g. "local", "s3")
 * @param string root The root directory for the disk's files
 * @param string url The URL for the disk's files
 * @param string visibility The default visibility setting for the disk's files (e.g. "public", "private")
 * @note The "admin_import_folder" disk is important for the admin panel to import files correctly.
 */
return [
    'admin_file_upload'   => [
        'driver'     => 'local',
        'root'       => public_path(),
        'url'        => env('APP_URL'),
        'visibility' => 'public',
    ],
    'admin_import_folder' => [
        'driver'     => 'local',
        'root'       => base_path(),
        'visibility' => 'public',
    ],
];
