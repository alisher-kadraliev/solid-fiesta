<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**Products**/
Route::delete("products/destroy", [Products\ProductsController::class,"destroy"])->name("products.delete");
Route::resource("products", Products\ProductsController::class)->parameters(["products" => "products_id"])->names("products")->except(["show"])->whereNumber("products_id");