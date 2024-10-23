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
namespace App\Http\Controllers\Admin\IletiimBiligleri;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class IletiimBiligleriController extends Controller
{   
    public array $menu = ["item" =>"iletiim_biligleri", "folder" =>"iletiim_biligleri", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['iletiim_biligleri_access'])) {
            abort(403);
        }

        $menu = $this->menu;
        return view("admin.iletiim_biligleri.index")->with(compact('menu'));
    }
    
}
