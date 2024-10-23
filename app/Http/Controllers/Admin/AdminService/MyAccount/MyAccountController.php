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

namespace App\Http\Controllers\Admin\AdminService\MyAccount;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminService\Auth\AuthUser;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public array $menu = ["item" => "my_account", "folder" => "", "subfolder" => ""];

    public function form()
    {
        $menu = $this->menu;
        return view("admin.admin_service.my_account.form")->with(compact('menu'));
    }

    public function updateUser(Request $request, AuthUser $AuthUser)
    {
        $this->validatorUser($request);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['image'] = $request->image;
        $data['theme'] = $request->theme ?? 'admiko';
        $data['language'] = $request->language ?? 'en';
        $AuthUser->find(auth()->user()->id)->update($data);
        return redirect(route("admin.my_account"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    private function validatorUser(Request $request)
    {
        $rules = [
            "name"  => [
                "string",
                "required"
            ],
            "image" => [
                "base64_validator:jpg,png,jpeg,webp",
                "required_without:ak_image_current"
            ],
            'email' => [
                "email",
                "unique:admin_users,email," . auth()->user()->id . ",id,deleted_at,NULL",
                'required'
            ],
        ];
        $request->validate($rules);
    }

    public function updatePassword(Request $request, AuthUser $AuthUser)
    {
        $this->validatorPassword($request);
        $data['password'] = bcrypt($request->password);
        $AuthUser->find(auth()->user()->id)->update($data);
        return redirect(route("admin.my_account"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
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
