<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('admin.dashboard');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class)->except('edit');
Route::get('category/{category:slug}', [CategoryController::class, 'edit'])->name('category.edit'); 

Route::resource('subcategory', SubcategoryController::class)->except('edit');
Route::get('subcategory/{subcategory:slug}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');

Route::resource('product', ProductController::class);
Route::get('product/{product:slug}', [ProductController::class, 'edit'])->name('product.edit');

//Route::get('subcategories/{id}', [ProductController::class, 'loadSubCategories']); 
Route::get('subcategories/{category}', [ProductController::class, 'loadSubCategories']); 
