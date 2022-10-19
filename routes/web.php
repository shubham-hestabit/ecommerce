<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;

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

// Route for Category Sidebar
Route::get('/categories', [HomeController::class, 'category'])->name('categories');
Auth::routes();

// Route for Sub Category Sidebar
Route::get('/sub-categories', [HomeController::class, 'subCategory'])->name('sub-categories');
Auth::routes();

// Route for Products Sidebar
Route::get('/products', [HomeController::class, 'products'])->name('products');
Auth::routes();


/**
 * CRUD Route for Category Resource
 */ 
Route::resource('category', CategoryController::class);

/**
 * CRUD Route for Sub Category Resource
 */ 
Route::resource('sub-category', SubCategoryController::class);

/**
 * CRUD Route for Products Resource
 */ 
// Route::resource('products', ProductController::class);