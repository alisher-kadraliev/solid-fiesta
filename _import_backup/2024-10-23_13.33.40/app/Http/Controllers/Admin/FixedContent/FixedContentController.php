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
namespace App\Http\Controllers\Admin\FixedContent;
use App\Http\Controllers\Controller;
use App\Models\Admin\FixedContent\FixedContent;
use App\Requests\Admin\FixedContent\FixedContentRequest;
use Illuminate\Support\Facades\Gate;
class FixedContentController extends Controller
{   
    public array $menu = ["item" =>"fixed_content", "folder" =>"", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['fixed_content_access'])) {
            abort(403);
        }
		$menu = $this->menu;

        $fixed_content_list_all = FixedContent::startSearch(Request()->query("fixed_content_search"))->orderByDesc("id")->get();
        return view("admin.fixed_content.index")->with(compact('menu','fixed_content_list_all'));
    }

    public function create()
    {
        if (Gate::none('fixed_content_create')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = new FixedContent();
        
        return view("admin.fixed_content.form")->with(compact('menu','data'));
    }

    public function store(FixedContentRequest $request)
    {
        if (Gate::none('fixed_content_create')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = FixedContent::create($requestAll);
        

        return redirect(route("admin.fixed_content.index"))->with("toast_success", trans('admin/misc.success_confirmation_created'));
    }

    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        if (Gate::none('fixed_content_edit')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = FixedContent::findOrFail(request()->route()->fixed_content_id);;
        
        return view("admin.fixed_content.form")->with(compact('menu', 'data'));
    }

    public function update(FixedContentRequest $request)
    {
        if (Gate::none('fixed_content_edit')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = FixedContent::findOrFail(request()->route()->fixed_content_id);
        $run->update($requestAll);
        return redirect(route("admin.fixed_content.index"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    public function destroy()
    {
        if (Gate::none('fixed_content_delete')) {
            abort(403);
        }
        FixedContent::destroy(Request()->delete_id);
        return redirect(route("admin.fixed_content.index"))->with("toast_success", trans('admin/misc.success_confirmation_deleted'));
    }
    
}
