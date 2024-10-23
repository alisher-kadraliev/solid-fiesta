<?php
/**
 * Configuration settings for the admin panel.
 *
 * @param string admin_url URL for the admin panel
 * @param string backup_folder Folder name for backup files
 * @param string upload_disk Disk to store uploaded files. You can also use disks name from config/filesystems.php
 * @param string default_language Default language for the admin panel
 * @param string default_language_import_folder Default folder where to store translation files for pages
 * @param string default_template Name of the template for the admin login page
 * @param bool load_admin_provider_global Whether to load the admin provider globally
 * @param bool load_admin_routes_global Whether to load the admin routes globally
 * @param bool allow_login_password_reset Whether to allow password reset
 * @param bool disable_import_page Disable admin import page
 */
return [
    'admin_url'                      => 'admin',
    'backup_folder'                  => '_import_backup',
    'upload_disk'                    => 'admin_file_upload',
    'default_language'               => 'en',
    'default_language_import_folder' => 'lang/en/admin/pages/',
    'default_template'               => 'admiko',
    'load_admin_provider_global'     => true,
    'load_admin_routes_global'       => false,
    'allow_login_password_reset'     => false,
    'disable_import_page'            => false,
];
