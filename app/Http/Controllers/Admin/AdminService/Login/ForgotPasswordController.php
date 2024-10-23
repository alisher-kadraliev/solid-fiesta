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
use App\Models\Admin\AdminService\Auth\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function index()
    {
        if(!config('admin.settings.allow_login_password_reset')){
            abort(404);
        }
        return view('admin.admin_service.login.password_reset.enter_email');
    }

    public function sendResetLink(Request $request, AuthUser $Users)
    {
        if(!config('admin.settings.allow_login_password_reset')){
            abort(404);
        }
        $this->validatorEmail($request);
        $email = $Users->where('email', $request->email)->first();
        if ($email) {
            $reset_token = Str::random(80);
            $data['reset_token'] = $reset_token;
            $email->update($data);
            $data['email'] = $email->email;
            Mail::to($email->email)->send(new EmailResetLink($data));
            return redirect()->back()->with('message_sent', trans('admin/admin_service/login.reset_email_sent_success'));
        } else {
            return redirect()->back()->withInput()->with('error', trans('admin/admin_service/login.reset_email_send_fail'));
        }
    }

    private function validatorEmail(Request $request)
    {
        $rules = [
            'email' => 'required|email:filter'
        ];
        $request->validate($rules);
    }

    public function showResetForm(Request $request, AuthUser $Users)
    {
        if(!config('admin.settings.allow_login_password_reset')){
            abort(404);
        }
        $token = $this->checkToken($request, $Users);
        if ($token) {
            $reset_token = $request->reset_token;
            return view('admin.admin_service.login.password_reset.reset')->with(compact('reset_token'));
        }
        return redirect(route('admin.login'));
    }

    private function checkToken(Request $request, AuthUser $Users)
    {
        if (isset($request->reset_token) && !empty($request->reset_token)) {
            return $Users->where('reset_token', $request->reset_token)->first();
        }
        return null;
    }

    public function updatePassword(Request $request, AuthUser $Users)
    {
        if(!config('admin.settings.allow_login_password_reset')){
            abort(404);
        }
        $this->validatorPassword($request);
        $token = $this->checkToken($request, $Users);
        if ($token) {
            $data['password'] = bcrypt($request->password);
            $data['reset_token'] = null;
            $Users->find($token->id)->update($data);
        }
        return redirect(route('admin.login'));
    }

    private function validatorPassword(Request $request)
    {
        $rules = [
            'password'              => 'required_with:password_confirmation|same:password_confirmation|string|min:6|max:255',
            'password_confirmation' => 'min:6|max:255'
        ];
        $request->validate($rules);
    }
}
