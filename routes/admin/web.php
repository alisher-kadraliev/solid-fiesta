<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 *
 * Any CUSTOM routes should be added to a separate file inside /routes/admin/routes_public/ and /routes/admin/routes_protected/ folder.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::prefix(config('admin.settings.admin_url'))->name('admin.')->middleware('admin')->group(function () {

    /**Add your CUSTOM PUBLIC admin routes in /routes/admin/routes_public/ folder.**/
    $files = glob(base_path('routes/admin/routes_public/*.php'), GLOB_BRACE);
    foreach ($files as $file) {
        require_once $file;
    }
    /**Admin service public routes**/
    require_once "admin_service/web.php";

    Route::middleware(['admin_auth:admin_guard'])->group(function () {
        /**Add your CUSTOM PROTECTED admin routes in /routes/admin/routes_protected/ folder.**/
        $files = glob(base_path('routes/admin/routes_protected/*.php'), GLOB_BRACE);
        foreach ($files as $file) {
            require_once $file;
        }

        /**Admin service protected routes**/
        require_once "admin_service/web_auth.php";

        /**Imported routes**/
        $files = glob(base_path('routes/admin/routes_import/*.php'), GLOB_BRACE);
        foreach ($files as $file) {
            require_once $file;
        }
    });
});
