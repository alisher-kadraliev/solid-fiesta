<?php

namespace App\Http\Controllers;

use App\Models\Admin\FixedContent\FixedContent;
use App\Models\Admin\HomeSlider\HomeSlider;
use App\Models\Admin\SocialLinks\SocialLinks;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function app()
    {
        $socialLinks = SocialLinks::first();
        $sliders = HomeSlider::all();
        $fixedContent = FixedContent::first();
        return view('front.index', compact('socialLinks','sliders','fixedContent'));
    }

    public function about(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.about',compact('socialLinks','fixedContent'));
    }
    public function media(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.media',compact('socialLinks','fixedContent'));
    }
    public function certificate(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.certificate',compact('socialLinks','fixedContent'));
    }
    public function productsCategories(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.productsCategories',compact('socialLinks','fixedContent'));
    }
    public function products(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.products',compact('socialLinks','fixedContent'));
    }
    public function product(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.product',compact('socialLinks','fixedContent'));
    }
    public function bombusbee(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.bombusbee',compact('socialLinks','fixedContent'));
    }
    public function contact(){
        $socialLinks = SocialLinks::first();
        $fixedContent = FixedContent::first();

        return view('front.contact',compact('socialLinks','fixedContent'));
    }
}
