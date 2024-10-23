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
namespace App\Http\Controllers\Admin\Products;
use App\Http\Controllers\Controller;
use App\Models\Admin\Products\Products;
use App\Requests\Admin\Products\ProductsRequest;
use Illuminate\Support\Facades\Gate;
class ProductsController extends Controller
{   
    public array $menu = ["item" =>"products", "folder" =>"", "subfolder" =>""];

    public function index()
    {
        if (Gate::none(['products_access'])) {
            abort(403);
        }
		$menu = $this->menu;

        $products_list_all = Products::startSearch(Request()->query("products_search"))->orderByDesc("id")->get();
        return view("admin.products.index")->with(compact('menu','products_list_all'));
    }

    public function create()
    {
        if (Gate::none('products_create')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = new Products();
        
        return view("admin.products.form")->with(compact('menu','data'));
    }

    public function store(ProductsRequest $request)
    {
        if (Gate::none('products_create')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = Products::create($requestAll);
        

        return redirect(route("admin.products.index"))->with("toast_success", trans('admin/misc.success_confirmation_created'));
    }

    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        if (Gate::none('products_edit')) {
            abort(403);
        }
        $menu = $this->menu;
        $data = Products::findOrFail(request()->route()->products_id);;
        
        return view("admin.products.form")->with(compact('menu', 'data'));
    }

    public function update(ProductsRequest $request)
    {
        if (Gate::none('products_edit')) {
            abort(403);
        }
        $requestAll = $request->all();
        $run = Products::findOrFail(request()->route()->products_id);
        $run->update($requestAll);
        return redirect(route("admin.products.index"))->with("toast_success", trans('admin/misc.success_confirmation_updated'));
    }

    public function destroy()
    {
        if (Gate::none('products_delete')) {
            abort(403);
        }
        Products::destroy(Request()->delete_id);
        return redirect(route("admin.products.index"))->with("toast_success", trans('admin/misc.success_confirmation_deleted'));
    }
    
}
