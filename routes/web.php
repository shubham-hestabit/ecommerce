<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Home Page Route
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();


/**
 * CRUD Route for Category Resource
 */ 
Route::resource('category', CategoryController::class);

/**
 * CRUD Route for Sub Category Resource
 */ 
Route::resource('sub-category', SubCategoryController::class);

Route::get('/sub-category/create/{id}', [SubCategoryController::class, 'create'])->name('sc-create');

/**
 * CRUD Route for Products Resource
 */ 
Route::resource('/product', ProductController::class);

Route::get('/product/create/{id}', [ProductController::class, 'create'])->name('product-create');

///
// Route::view('/cart', 'layouts.add_to_cart');

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart-save', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');