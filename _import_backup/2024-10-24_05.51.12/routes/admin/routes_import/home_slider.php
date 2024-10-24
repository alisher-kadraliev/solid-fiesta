<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**HomeSlider**/
Route::delete("home-slider/destroy", [HomeSlider\HomeSliderController::class,"destroy"])->name("home_slider.delete");
Route::resource("home-slider", HomeSlider\HomeSliderController::class)->parameters(["home-slider" => "home_slider_id"])->names("home_slider")->except(["show"])->whereNumber("home_slider_id");