<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;

Route::get('/', [FrontendProductController::class, 'index']);
Route::get('/product/{product:slug}', [FrontendProductController::class, 'show'])->name('product.view');
Route::get('/category/{category:slug}', [FrontendProductController::class, 'allProduct'])->name('product.list');
Route::get('all/products', [FrontendProductController::class, 'moreProducts'])->name('more.product');

Route::get('/addToCart/{product}', [CartController::class, 'addToCart'])->name('add.cart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/products/{product}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/product/{product}', [CartController::class, 'removeCart'])->name('cart.remove');
Route::get('/checkout/{amount}', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/charge', [CartController::class, 'charge'])->name('cart.charge');
Route::get('/orders', [CartController::class, 'order'])->name('order')->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'isAdmin']], function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('category', CategoryController::class)->except('edit');
    Route::get('category/{category:slug}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::resource('subcategory', SubcategoryController::class)->except('edit');
    Route::get('subcategory/{subcategory:slug}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');

    Route::resource('product', ProductController::class);
    Route::get('product/{product:slug}', [ProductController::class, 'edit'])->name('product.edit');
    //Route::get('subcategories/{id}', [ProductController::class, 'loadSubCategories']); 
    Route::get('subcategories/{category}', [ProductController::class, 'loadSubCategories']); 

    Route::resource('slider', SliderController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('users', [UserController::class, 'index'])->name('user.index');
});