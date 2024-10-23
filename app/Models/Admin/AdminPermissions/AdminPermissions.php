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
namespace App\Models\Admin\AdminPermissions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AdminRoles\AdminRoles;

class AdminPermissions extends Model
{

    public $table = 'admin_permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "title",
        "permission_slug",
        "custom_permission",
    ];

    public function rolesMany()
    {
        return $this->belongsToMany(AdminRoles::class, 'admin_role_permission', 'admin_permissions_id', 'admin_roles_id');
    }
    public function scopeStartSearch($query, $search)
    {
        if ($search) {
            $query->where("title","like","%".$search."%")
                ->orWhere("permission_slug","like","%".$search."%");
        }
    }
}
