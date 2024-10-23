<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**IletiimBiligleri**/
Route::get("iletiim-biligleri", [IletiimBiligleri\IletiimBiligleriController::class,"index"])->name("iletiim_biligleri");
/**SocialLinks1**/
Route::delete("iletiim-biligleri/social-links-1/destroy", [IletiimBiligleri\SocialLinks1Controller::class,"destroy"])->name("iletiim_biligleri.social_links_1.delete");
Route::resource("iletiim-biligleri/social-links-1", IletiimBiligleri\SocialLinks1Controller::class)->parameters(["social-links-1" => "social_links_1_id"])->names("iletiim_biligleri.social_links_1")->except(["show"])->whereNumber("social_links_1_id");