<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.
 *
 * Protected admin routes.
 * Any PROTECTED CUSTOM admin routes should be added to a separate file inside /routes/admin/routes_protected/ folder.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

/**Home page**/
Route::get('/', [Home\HomeController::class, 'index'])->name('home');

/**My Account page**/
Route::get('my_account', [AdminService\MyAccount\MyAccountController::class, 'form'])->name('my_account');
Route::put('my_account/update', [AdminService\MyAccount\MyAccountController::class, 'updateUser'])->name('my_account.update');
Route::put('my_account/update-password', [AdminService\MyAccount\MyAccountController::class, 'updatePassword'])->name('my_account.update_password');

/**Admin Service**/
Route::get('admin-import', [AdminService\AdminImport\AdminImportController::class, 'index'])->name('ak_admin_import');
Route::post('admin-import/update', [AdminService\AdminImport\AdminImportController::class, 'updateFiles'])->name('ak_admin_import.update');
Route::post('admin-import/pages', [AdminService\AdminImport\AdminImportController::class, 'pageImport'])->name('ak_admin_import.pages');
Route::post('admin-import/refresh', [AdminService\AdminImport\AdminImportController::class, 'refreshFiles'])->name('ak_admin_import.refresh');

Route::get('admin-import/lang', [AdminService\AdminImport\AdminImportController::class, 'languages'])->name('ak_admin_languages');
Route::post('admin-import/lang', [AdminService\AdminImport\AdminImportController::class, 'languagesImport'])->name('ak_admin_languages.import');

/**Logout Routs**/
Route::get('logout', [AdminService\Login\LoginController::class, 'logout'])->name('logout');
