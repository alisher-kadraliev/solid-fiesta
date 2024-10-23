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

namespace App\Models\Admin\AdminService\Auth;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Admin\AdminService\Traits\AdminHelperTrait;
use App\Models\Admin\AdminRoles\AdminRoles;
class AuthUser extends Authenticatable
{
    use HasFactory, Notifiable, AdminHelperTrait;

    public $table = 'admin_users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'theme',
        'image',
        'language',
        'reset_token',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setImageAttribute()
    {
        if (request()->filled('image')) {
            $this->attributes['image'] = request()->image;
        }
    }
    public function rolesMany()
    {
        return $this->belongsToMany(AdminRoles::class, 'admin_user_role', 'admin_users_id', 'admin_roles_id');
    }
}
