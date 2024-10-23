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

namespace App\Http\Middleware\Admin;

use App\Models\Admin\AdminPermissions\AdminPermissions;
use Closure;
use Illuminate\Support\Facades\Gate;

class AdminGates
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user) {
            //->guard('admin_guard')
            app()->setLocale($user->language);
            if ($user->id == 1 || $user->rolesMany->contains('id', 1)) {
                /**Full access for Administrators**/
                Gate::after(function () {
                    return true;
                });
            } else {
                $allUserPermissions = AdminPermissions::whereHas('rolesMany', function ($query) use ($user) {
                    $query->whereIn('admin_roles.id', $user->rolesMany->pluck('id'));
                })->get();
                foreach ($allUserPermissions as $permissions) {
                    Gate::define($permissions->permission_slug, function () {
                        return true;
                    });
                }
            }
        }
        return $next($request);
    }
}
