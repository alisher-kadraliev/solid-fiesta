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
namespace App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public array $menu = ["item" =>"home", "folder" =>"home", "subfolder" =>""];

    public function index()
    {
        $menu = $this->menu;
        return view("admin.home.index")->with(compact('menu'));
    }
}