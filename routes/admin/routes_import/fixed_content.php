<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**FixedContent**/
Route::delete("fixed-content/destroy", [FixedContent\FixedContentController::class,"destroy"])->name("fixed_content.delete");
Route::resource("fixed-content", FixedContent\FixedContentController::class)->parameters(["fixed-content" => "fixed_content_id"])->names("fixed_content")->except(["show"])->whereNumber("fixed_content_id");