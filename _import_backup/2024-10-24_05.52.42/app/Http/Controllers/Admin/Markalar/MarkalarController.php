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
namespace App\Http\Controllers\Admin\Markalar;
use App\Http\Controllers\Controller;
use App\Models\Admin\Markalar\Markalar;
use App\Requests\Admin\Markalar\MarkalarRequest;
use Illuminate\Support\Facades\Gate;
class MarkalarController extends Controller
{   
    public array $menu = ["item" =>"markalar", "folder" =>"", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['markalar_access'])) {
            abort(403);
        }
		$menu = $this->menu;

        $markalar_list_all = Markalar::startSearch(Request()->query("markalar_search"))->orderByDesc("id")->get();
        return view("admin.markalar.index")->with(compact('menu','markalar_list_all'));
    }

    public function create()
    {
        if (Gate::none('markalar_create')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = new Markalar();
        
        return view("admin.markalar.form")->with(compact('menu','data'));
    }

    public function store(MarkalarRequest $request)
    {
        if (Gate::none('markalar_create')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = Markalar::create($requestAll);
        

        return redirect(route("admin.markalar.index"))->with("toast_success", trans('admin/misc.success_confirmation_created'));
    }

    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        if (Gate::none('markalar_edit')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = Markalar::findOrFail(request()->route()->markalar_id);;
        
        return view("admin.markalar.form")->with(compact('menu', 'data'));
    }

    public function update(MarkalarRequest $request)
    {
        if (Gate::none('markalar_edit')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = Markalar::findOrFail(request()->route()->markalar_id);
        $run->update($requestAll);
        return redirect(route("admin.markalar.index"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    public function destroy()
    {
        if (Gate::none('markalar_delete')) {
            abort(403);
        }
        Markalar::destroy(Request()->delete_id);
        return redirect(route("admin.markalar.index"))->with("toast_success", trans('admin/misc.success_confirmation_deleted'));
    }
    
}
