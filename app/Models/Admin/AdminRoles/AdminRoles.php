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
namespace App\Models\Admin\AdminRoles;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AdminPermissions\AdminPermissions;
use App\Models\Admin\AdminUsers\AdminUsers;

class AdminRoles extends Model
{

    public $table = 'admin_roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "title",
    ];

    public function usersListAll()
    {
        return AdminUsers::all()->sortBy("name");
    }
    public function usersMany()
    {
        return $this->belongsToMany(AdminUsers::class, 'admin_user_role', 'admin_users_id', 'admin_roles_id');
    }
    public function permissionsListAll()
    {
        return AdminPermissions::all()->sortBy("permission_slug");
    }
    public function permissionsMany()
    {
        return $this->belongsToMany(AdminPermissions::class, 'admin_role_permission', 'admin_roles_id', 'admin_permissions_id');
    }
    public function scopeStartSearch($query, $search)
    {
        if ($search) {
            $query->where("title","like","%".$search."%")
                ->orWhereHas("usersMany", function($q) use($search) { $q->where("name","like","%".$search."%"); })
                ->orWhereHas("permissionsMany", function($q) use($search) { $q->where("permission_slug","like","%".$search."%"); });
        }
    }
}
