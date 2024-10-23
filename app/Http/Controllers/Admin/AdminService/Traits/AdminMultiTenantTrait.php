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
use App\Models\Admin\AdminUsers\AdminUsers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait AdminMultiTenantTrait
{
    public static function bootAdminMultiTenantTrait()
    {
        static::creating(function (Model $model) {
            if ($model->isFillable('created_by')) {
                $model->created_by = auth()->id();
            }
            if (auth()->user()->team_id && $model->isFillable('created_by_team')) {
                $model->created_by_team = auth()->user()->team_id;
            }
        });

        static::updating(function (Model $model) {
            if ($model->isFillable('updated_by')) {
                $model->updated_by = auth()->id();
            }
        });

        static::deleted(function (Model $model) {
            if (method_exists($model, 'runSoftDelete')) {
                if ($model->isFillable('deleted_by')) {
                    $model->deleted_by = auth()->id();
                    $model->saveQuietly();
                    $model->adminDeleteCascadeUpdate(get_class($model), [$model->id]);
                }
            }
        });

        if(auth()->id() != 1){
            if(!auth()->user()->rolesMany()->get()->contains(1)){
                if (auth()->user()->team_id && app(get_class())->isFillable('created_by_team')) {
                    static::addGlobalScope('created_by_team', function (Builder $builder)  {
                        $builder->where('created_by_team',auth()->user()->team_id)->orWhereNull('created_by_team');
                    });
                }
                if (app(get_class())->isFillable('created_by')) {
                    $tenancy_users = AdminUsers::where('id',auth()->id())->first()->multiTenancyMany()->get()->pluck('id');
                    if (auth()->user()->team_id && app(get_class())->isFillable('created_by_team')) {
                        static::addGlobalScope('created_by', function (Builder $builder) use ($tenancy_users) {
                            $builder->orWhere('created_by',auth()->id())->orWhereIn('created_by', $tenancy_users)->orWhereNull('created_by');
                        });
                    } else {
                        static::addGlobalScope('created_by', function (Builder $builder) use ($tenancy_users) {
                            $builder->where('created_by',auth()->id())->orWhereIn('created_by', $tenancy_users)->orWhereNull('created_by');
                        });
                    }
                }
            }
        }
    }

    protected static function adminDeleteCascadeUpdate($modelPath, $deleteId)
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
                            self::adminDeleteCascadeUpdate($path . $model, $deleteIdArray);
                        }
                    }
                    $getModel::whereIn($key_id, $deleteId)->update(['deleted_by' => auth()->id()]);
                }
            }
        }
    }
}
