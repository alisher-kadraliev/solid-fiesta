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

namespace App\Http\Controllers\Admin\AdminService\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('admin_guest:admin_guard')->except('logout');
//    }

    public function index()
    {
        return view('admin.admin_service.login.login')->with('error', '');
    }

    public function login(Request $request)
    {
        $this->validator($request);
        if (Auth::guard('admin_guard')->attempt(($request->only('email', 'password')+['active'=>1]), $request->filled('remember'))) {
            return redirect()->intended(route('admin.home'));
        }
        return redirect()->back()->withInput()->with('error', trans('admin/admin_service/login.login_failed'));
    }

    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email:filter|exists:admin_users',
            'password' => 'required|string|min:6|max:255'
        ];
        $request->validate($rules);
    }

    public function logout()
    {
        Auth::guard('admin_guard')->logout();
        return redirect()->route('admin.login');
    }
}
