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
namespace App\Http\Controllers\Admin\HomeSlider;
use App\Http\Controllers\Controller;
use App\Models\Admin\HomeSlider\HomeSlider;
use App\Requests\Admin\HomeSlider\HomeSliderRequest;
use Illuminate\Support\Facades\Gate;
class HomeSliderController extends Controller
{   
    public array $menu = ["item" =>"home_slider", "folder" =>"", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['home_slider_access'])) {
            abort(403);
        }
		$menu = $this->menu;

        $home_slider_list_all = HomeSlider::startSearch(Request()->query("home_slider_search"))->orderByDesc("id")->get();
        return view("admin.home_slider.index")->with(compact('menu','home_slider_list_all'));
    }

    public function create()
    {
        if (Gate::none('home_slider_create')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = new HomeSlider();
        
        return view("admin.home_slider.form")->with(compact('menu','data'));
    }

    public function store(HomeSliderRequest $request)
    {
        if (Gate::none('home_slider_create')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = HomeSlider::create($requestAll);
        

        return redirect(route("admin.home_slider.index"))->with("toast_success", trans('admin/misc.success_confirmation_created'));
    }

    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        if (Gate::none('home_slider_edit')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = HomeSlider::findOrFail(request()->route()->home_slider_id);;
        
        return view("admin.home_slider.form")->with(compact('menu', 'data'));
    }

    public function update(HomeSliderRequest $request)
    {
        if (Gate::none('home_slider_edit')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = HomeSlider::findOrFail(request()->route()->home_slider_id);
        $run->update($requestAll);
        return redirect(route("admin.home_slider.index"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    public function destroy()
    {
        if (Gate::none('home_slider_delete')) {
            abort(403);
        }
        HomeSlider::destroy(Request()->delete_id);
        return redirect(route("admin.home_slider.index"))->with("toast_success", trans('admin/misc.success_confirmation_deleted'));
    }
    
}
