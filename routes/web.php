<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\FrontController::class, 'app'])->name('index');
Route::get('/bambusbee', [\App\Http\Controllers\FrontController::class, 'bambusbee'])->name('bambusbee');
Route::get('/about', [\App\Http\Controllers\FrontController::class, 'about'])->name('about');
Route::get('/media', [\App\Http\Controllers\FrontController::class, 'media'])->name('media');
Route::get('/certificate', [\App\Http\Controllers\FrontController::class, 'certificate'])->name('certificate');
Route::get('/products-categories', [\App\Http\Controllers\FrontController::class, 'productsCategories'])->name('productsCategories');
Route::get('/products', [\App\Http\Controllers\FrontController::class, 'products'])->name('products');
Route::get('/bombusbee', [\App\Http\Controllers\FrontController::class, 'bombusbee'])->name('bombusbee');
Route::get('/product', [\App\Http\Controllers\FrontController::class, 'product'])->name('product');
Route::get('/contact', [\App\Http\Controllers\FrontController::class, 'contact'])->name('contact');
