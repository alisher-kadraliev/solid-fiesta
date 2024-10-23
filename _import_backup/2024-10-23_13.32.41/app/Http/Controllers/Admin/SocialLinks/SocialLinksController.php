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
namespace App\Http\Controllers\Admin\SocialLinks;
use App\Http\Controllers\Controller;
use App\Models\Admin\SocialLinks\SocialLinks;
use App\Requests\Admin\SocialLinks\SocialLinksRequest;
use Illuminate\Support\Facades\Gate;
class SocialLinksController extends Controller
{   
    public array $menu = ["item" =>"social_links", "folder" =>"", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['social_links_access'])) {
            abort(403);
        }
		$menu = $this->menu;

        
        $row = SocialLinks::first();
        if($row){
            return redirect(route("admin.social_links.edit",$row->id));
        } else {
            return redirect(route("admin.social_links.create"));
        }

        
    }

    public function create()
    {
        if (Gate::none('social_links_create')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = new SocialLinks();
        
        return view("admin.social_links.form")->with(compact('menu','data'));
    }

    public function store(SocialLinksRequest $request)
    {
        if (Gate::none('social_links_create')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = SocialLinks::create($requestAll);
        

        return redirect(route("admin.social_links.index"))->with("toast_success", trans('admin/misc.success_confirmation_created'));
    }

    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        if (Gate::none('social_links_edit')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = SocialLinks::findOrFail(request()->route()->social_links_id);;
        
        return view("admin.social_links.form")->with(compact('menu', 'data'));
    }

    public function update(SocialLinksRequest $request)
    {
        if (Gate::none('social_links_edit')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = SocialLinks::findOrFail(request()->route()->social_links_id);
        $run->update($requestAll);
        return back()->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    public function destroy()
    {
        if (Gate::none('social_links_delete')) {
            abort(403);
        }
        SocialLinks::destroy(Request()->delete_id);
        return redirect(route("admin.social_links.index"))->with("toast_success", trans('admin/misc.success_confirmation_deleted'));
    }
    
}
