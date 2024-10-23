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

use App\Models\Admin\AdminAuditableLogs\AdminAuditableLogs;
use Illuminate\Database\Eloquent\Model;

trait AdminAuditableTrait
{
    public static function bootAdminAuditableTrait()
    {
        static::created(function (Model $model) {
            self::adminSaveAuditable('created', $model);
        });
        static::updated(function (Model $model) {
            self::adminSaveAuditable('updated', $model);
        });
        static::deleted(function (Model $model) {
            self::adminSaveAuditable('deleted', $model);
            if (!method_exists($model, 'runSoftDelete')) {
                self::adminSoftDeleteCascadeLog(get_class($model), [$model->id]);
            }
        });
    }

    protected static function adminSaveAuditable($action, $model)
    {
        AdminAuditableLogs::create([
            'action'         => $action,
            'user_id'        => auth()->id() ?? null,
            'model'          => get_class($model) ?? null,
            'row_id'         => $model->id ?? null,
            'properties_old' => $model->getOriginal()?json_encode($model->getOriginal()):"" ?? null,
            'properties_new' => ($action != 'deleted')?(json_encode($model) ?? null):null,
            'url'            => url()->current() ?? null,
            'ip'             => request()->ip() ?? null,
        ]);
    }

    protected static function adminSoftDeleteCascadeLog($modelPath, $deleteId)
    {
        $path = 'App\Models\Admin\\';
        if (property_exists(app($modelPath), 'adminCascadeModels')) {
            $cascade = $modelPath::$adminCascadeModels;
            foreach ($cascade as $key_id => $modelArray) {
                foreach ($modelArray as $model) {
                    $getModel = app($path . $model);
                    if (property_exists($getModel, 'adminCascadeModels')) {
                        $deleteIdArray = $getModel::whereIn($key_id, $deleteId)->pluck('id');
                        if (count($deleteIdArray) > 0) {
                            self::adminSoftDeleteCascadeLog($path . $model, $deleteIdArray);
                        }
                    }
                    $deleteIdArray = $getModel::whereIn($key_id, $deleteId)->get();
                    foreach ($deleteIdArray as $singleId) {
                        self::adminSaveAuditable('deleted', $getModel::find($singleId->id));
                    }
                }
            }
        }
    }
}
