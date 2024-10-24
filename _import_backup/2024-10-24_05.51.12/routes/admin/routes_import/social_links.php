<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**SocialLinks**/
Route::delete("social-links/destroy", [SocialLinks\SocialLinksController::class,"destroy"])->name("social_links.delete");
Route::resource("social-links", SocialLinks\SocialLinksController::class)->parameters(["social-links" => "social_links_id"])->names("social_links")->except(["show"])->whereNumber("social_links_id");