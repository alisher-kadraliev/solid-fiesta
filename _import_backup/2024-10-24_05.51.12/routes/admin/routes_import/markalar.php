<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**Markalar**/
Route::delete("markalar/destroy", [Markalar\MarkalarController::class,"destroy"])->name("markalar.delete");
Route::resource("markalar", Markalar\MarkalarController::class)->parameters(["markalar" => "markalar_id"])->names("markalar")->except(["show"])->whereNumber("markalar_id");