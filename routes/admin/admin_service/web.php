<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.
 *
 * Public admin routes.
 * Any PUBLIC CUSTOM admin routes should be added to a separate file inside /routes/admin/routes_public/ folder.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::get('login', [AdminService\Login\LoginController::class, 'index'])->name('login');
Route::post('login', [AdminService\Login\LoginController::class, 'login'])->name('login');
/**Forgot Password Routes**/
Route::get('login/email', [AdminService\Login\ForgotPasswordController::class, 'index'])->name('login.email');
Route::post('login/send', [AdminService\Login\ForgotPasswordController::class, 'sendResetLink'])->name('login.send');
/**Reset Password Routes**/
Route::get('login/reset/{reset_token}', [AdminService\Login\ForgotPasswordController::class, 'showResetForm'])->name('login.reset');
Route::post('login/reset/{reset_token}', [AdminService\Login\ForgotPasswordController::class, 'updatePassword'])->name('login.update');
