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

namespace App\Http\Controllers\Admin\AdminService\AdminImport;

use App\Http\Controllers\Admin\AdminService\Traits\AdminDatabaseTrait;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminPermissions\AdminPermissions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AdminImportController extends Controller
{
    use AdminDatabaseTrait;

    public array $menu = ["item" => "", "folder" => "", "subfolder" => ""];

    public function index()
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            return redirect(route("admin.home"));
        }
        $dataApi = $this->makeRequest(['all_pages' => 1]);
        if ($dataApi->success) {
            $return = json_decode(base64_decode($dataApi->return));
        } else {
            $error = $dataApi->message??"Invalid response, please try again or contact Admiko support.";
        }
        if(session('message')) {
            $error = session('message');
        }
        return view("admin.admin_service.admin_import.index", ["menu" => $this->menu, "data" => $return ?? [], "error" => $error ?? ""]);
    }
    public function languages()
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            return redirect(route("admin.home"));
        }
        $dataApi = $this->makeRequest(['all_lang' => 1]);

        if ($dataApi->success) {
            $return = json_decode(base64_decode($dataApi->return));
        } else {
            $error = $dataApi->message??"Invalid response, please try again or contact Admiko support.";
        }
        if(session('message')) {
            $error = session('message');
        }
        return view("admin.admin_service.admin_import.language", ["menu" => $this->menu, "data" => $return ?? [], "error" => $error ?? ""]);
    }
    public function languagesImport(Request $request)
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            abort(404);
        }
        $backup_folder = $this->backupFolder($request);
        foreach ($request->lang_id as $id) {
            $dataApi = $this->makeRequest(['lang_id' => $id]);
            if ($dataApi->success) {
                $this->startImport($dataApi, $backup_folder);
            } else {
                return response()->json(['success' => false, 'message' => $dataApi->message]);
            }
            return response()->json(['success' => true, 'backup_folder' => $backup_folder]);
        }
        return response()->json(['success' => false, 'message' => "Local error!"]);
    }
    public function updateFiles(Request $request)
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            abort(404);
        }
        $backup_folder = $this->backupFolder($request);
        $dataApi = $this->makeRequest(['update' => 1]);

        if ($dataApi->success) {
            $this->startImport($dataApi, $backup_folder);
        } else {
            return redirect(route('admin.ak_admin_import'))->with("message",$dataApi->message??"Error on update.");
        }
        return redirect(route('admin.ak_admin_import'))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }
    public function pageImport(Request $request)
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            abort(404);
        }
        $backup_folder = $this->backupFolder($request);
        foreach ($request->page_id as $id) {
            $dataApi = $this->makeRequest(['page_id' => $id, 'import_page' => 1]);
            if ($dataApi->success) {
                $this->startImport($dataApi, $backup_folder);
            } else {
                return response()->json(['success' => false, 'message' => $dataApi->message]);
            }
            return response()->json(['success' => true, 'backup_folder' => $backup_folder]);
        }
        return response()->json(['success' => false, 'message' => "Local error!"]);
    }
    public function refreshFiles(Request $request)
    {
        if (config('admin.settings.disable_import_page') || (auth()->user()->id != 1 && !auth()->user()->rolesMany->contains('id', 1))) {
            abort(404);
        }
        $backup_folder = $this->backupFolder($request);
        $dataApi = $this->makeRequest(['refresh_files' => 1]);

        if ($dataApi->success) {
            $this->startImport($dataApi, $backup_folder);
        } else {
            return response()->json(['success' => false, 'message' => $dataApi->message]);
        }
        return response()->json(['success' => true, 'backup_folder' => $backup_folder]);
    }

    public function backupFolder($request)
    {
        if (isset($request->backup_folder) && !empty($request->backup_folder)) {
            return $request->backup_folder;
        } else {
            return Carbon::now()->format("Y-m-d_H.i.s");
        }
    }

    public function makeRequest($send_data)
    {
        $apiUrl = 'https://api.admiko.com/import/v1';

        if (!$send_data['key'] = env('ADMIKO_APP_KEY', false)) {
            return (object)['success' => false, 'message' => 'Error: ADMIKO_APP_KEY is missing in the .env file.'];
        }
        $send_data['version'] = config("admin.version.version", false);
        $send_data['laravel_version'] = app()->version();

        try {
            $response = Http::withoutVerifying()->acceptJson()->post($apiUrl, [
                'send' => base64_encode(json_encode($send_data))
            ]);
            if ($response->successful()) {
                /*check if response is valid JSON format*/
                json_decode($response->body());
                if (json_last_error() != JSON_ERROR_NONE) {
                    /*There was an error in response*/
                    return (object)['success' => false, 'message' => 'Invalid data response from the server, please try again or contact Admiko support.'];
                } else {
                    /*huh, everything is fine ;)*/
                    return $response->object();
                }

            } else {
                return (object)['success' => false, 'message' => 'Invalid response from the server, please try again or contact Admiko support.'];
            }
        } catch (\Exception $e) {
            return (object)['success' => false, 'message' => 'Network or server error, please try later or contact Admiko support.'];
        }
    }
    public function startImport($dataApi, $backup_folder)
    {

        $return = json_decode(base64_decode($dataApi->return));

        if (isset($return->database) && count($return->database) > 0) {
            $this->setupDatabase($return->database);
        }

        if (isset($return->files) && count($return->files) > 0) {
            foreach ($return->files as $files) {
                $file = $files->file;
                $code = $files->code;
                $this->backupAndSave($file, $code, $backup_folder);
                $this->updatePermissions($files->permissions ?? false);
            }
        }
        if (isset($return->files_extended) && count($return->files_extended) > 0) {
            foreach ($return->files_extended as $files) {
                if (!Storage::disk('admin_import_folder')->exists($files->file)) {
                    Storage::disk('admin_import_folder')->put($files->file, $files->code);
                }
            }
        }
        if (isset($return->files_lang) && count($return->files_lang) > 0) {
            foreach ($return->files_lang as $files) {
                $file = config("admin.settings.default_language_import_folder").$files->file;
                $code = $files->code;
                $this->backupAndSave($file, $code, $backup_folder);
            }
        }
    }

    public function updatePermissions($all_permissions)
    {
        if ($all_permissions && count($all_permissions) > 0) {
            foreach ($all_permissions as $permission) {

                $permission_record = AdminPermissions::where('permission_slug', $permission->permission_slug)
                    ->where('custom_permission', 0)
                    ->first();
                if ($permission_record) {
                    $permission_record->update(['title' => $permission->title, 'custom_permission' => 0]);
                } else {
                    AdminPermissions::create(['title' => $permission->title, 'custom_permission' => 0, 'permission_slug' => $permission->permission_slug]);
                }
            }
        }
    }
    public function backupAndSave($file, $code, $backup_folder)
    {
        if (config('filesystems.disks.admin_import_folder')) {
            if (Storage::disk('admin_import_folder')->exists($file)) {
                if (Storage::disk('admin_import_folder')->exists(config("admin.settings.backup_folder") . '/' . $backup_folder . '/' . $file)) {
                    /**We don't want to lose any file**/
                    $file_new_name = $this->createUniqueName($file, $backup_folder, 1);
                    Storage::disk('admin_import_folder')->move($file, config("admin.settings.backup_folder") . '/' . $backup_folder . '/' . $file_new_name);
                } else {
                    Storage::disk('admin_import_folder')->move($file, config("admin.settings.backup_folder") . '/' . $backup_folder . '/' . $file);
                }
            }
            Storage::disk('admin_import_folder')->put($file, $code);
        } else {
            return redirect(route("admin.admiko_page_import"))->with('error', trans('admin.admiko_api_import_missing'));
        }
    }
    public function createUniqueName($file, $backup_folder, $counter)
    {
        if (Storage::disk('admin_import_folder')->exists(config("admin.settings.backup_folder") . '/' . $backup_folder . '/' . $file . $counter)) {
            $counter = $counter + 1;
            return $this->createUniqueName($file, $backup_folder, $counter);
        }
        return $file . $counter;
    }

}

