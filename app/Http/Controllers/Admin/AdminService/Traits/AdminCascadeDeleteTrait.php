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

use Illuminate\Database\Eloquent\Model;

trait AdminCascadeDeleteTrait
{
    public static function bootAdminCascadeDeleteTrait()
    {
        static::deleted(function (Model $model) {
            self::adminDeleteCascade(get_class($model), [$model->id]);
        });
    }

    protected static function adminDeleteCascade($modelPath, $deleteId)
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
                            self::adminDeleteCascade($path . $model, $deleteIdArray);
                        }
                    }
                    $deleteIdArray = $getModel::whereIn($key_id, $deleteId)->pluck('id');
                    $getModel::destroy($deleteIdArray);
                }
            }
        }
    }
}
