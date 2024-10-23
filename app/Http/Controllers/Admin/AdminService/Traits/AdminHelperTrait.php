<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

namespace App\Http\Controllers\Admin\AdminService\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait AdminHelperTrait
{
    public function getAdminThemes()
    {
        $get_files = Storage::disk('admin_import_folder')->files('config/admin/themes');
        $themes = [];
        foreach ($get_files as $themeFile) {
            $theme = include base_path($themeFile);
            $themes[$theme['folder']] = $theme['name'];
        }
        if (!$themes) {
            $themes['admiko'] = 'Admiko';
        }
        return $themes;
    }

    public function getAdminLanguages()
    {
        $get_folders = Storage::disk('admin_import_folder')->directories('lang/');
        $return = [];
        foreach ($get_folders as $languageFolder) {
            if (Storage::disk('admin_import_folder')->exists($languageFolder.'/admin/config/html.php')) {
                $language = include base_path($languageFolder.'/admin/config/html.php');
                if(key_exists('language_folder',$language) && key_exists('language_name',$language)){
                    $return[$language['language_folder']] = $language['language_name'];
                }
            }
        }
        if (!$return) {
            $return['en'] = 'English';
        } else {
            asort($return);
        }
        return $return;
    }

    public function TableUrl($request, $table_name)
    {
        $collect = [
            $table_name . "_source"    => $table_name,
            $table_name . "_search"    => "",
            $table_name . "_length"    => "",
            $table_name . "_sort_by"   => "",
            $table_name . "_direction" => "asc",
            $table_name . "_page"      => $request->query($table_name . "_page") ?? ""
        ];
        if ($request->query($table_name . '_source') == $table_name) {
            $collect[$table_name . '_search'] = $request->query($table_name . '_search') ?? "";
            $collect[$table_name . '_length'] = $request->query($table_name . '_length') ?? "";
            $collect[$table_name . '_sort_by'] = $request->query($table_name . '_sort_by') ?? "";
            $collect[$table_name . '_direction'] = $request->query($table_name . '_direction') ?? "asc";
        }
        $url['length_query'] = http_build_query(Arr::except($collect, [$table_name . '_length', $table_name . '_page']));
        $url['header_query'] = http_build_query(Arr::except($collect, [$table_name . '_sort_by', $table_name . '_direction']));
        $url['full_query'] = http_build_query($collect);
        return $url;
    }

}
