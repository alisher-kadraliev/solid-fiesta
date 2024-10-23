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

namespace App\Providers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AdmikoServiceProvider extends ServiceProvider
{
    public const HOME = '/';
    protected $routeMiddleware = [
        'admin_auth'  => \App\Http\Middleware\Admin\Authenticate::class,
        'admin_guest' => \App\Http\Middleware\Admin\RedirectIfAuthenticated::class,
    ];
    protected $middlewareGroups = [
        'admin' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\Admin\VerifyCsrfToken::class,
            \App\Http\Middleware\Admin\AdminGates::class,
        ],
    ];

    public function register(): void
    {
        if ($this->isAdmin() || config('admin.settings.load_admin_provider_global', [false])) {
            $this->registerRouteMiddleware();
        }
    }

    protected function isAdmin(): bool
    {
        if (request()->is(config('admin.settings.admin_url')) ||request()->is(config('admin.settings.admin_url') . '/*'))
        {
            return true;
        }
        return false;
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }

    public function boot(): void
    {
        if ($this->isAdmin() || config('admin.settings.load_admin_provider_global', [false])) {

            config(Arr::dot(config('admin.auth', []), 'auth.'));
            config(Arr::dot(config('admin.file_disks', []), 'filesystems.disks.'));

            if ($this->isAdmin() || config('admin.settings.load_admin_routes_global', [false])) {
                if (file_exists($routes = base_path('routes/admin/web.php'))) {
                    $this->loadRoutesFrom($routes);
                }
            }
            if ($this->isAdmin()) {
                Lang::setLocale(config('admin.settings.default_language', 'en'));
                config(['session.cookie' => 'admin_session']);
            }
//            Validator::extend('file_extension', [App\Http\Controllers\Admin\AdminService\Global\Validators::class, 'fileExtension']);
//            Validator::extend('base64_validator', [App\Http\Controllers\Admin\AdminService\Global\Validators::class, 'base64Validator']);
            Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
                $extension = $value->getClientOriginalExtension();
                return $extension != '' && in_array($extension, $parameters);
            });
            Validator::extend('base64_validator', function ($attribute, $value, $parameters, $validator) {
                if ($value) {
                    $image = base64_decode($value);
                    $pattern = '/<script\b[^>]*>(.*?)<\/script>/is';
                    if (preg_match($pattern, $image)) {
                        // JS code found in the image source
                        return false;
                    }
                    if (strpos($value, 'data:') !== false) {
                        [, $value] = explode('data:', $value);
                    }
                    if (!@getimagesize('data://' . $value)) {
                        return false;
                    } else {
                        return true;
                    }
                }
                return true;
            });
            require_once app_path('Http/Controllers/Admin/AdminService/Global/Helpers.php');
        }
    }
}
