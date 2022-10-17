<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

// Route for Category Sidebar
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'category'])->name('categories');
Auth::routes();

// Route for Sub Category Sidebar
Route::get('/sub-categories', [App\Http\Controllers\HomeController::class, 'sub-category'])->name('sub-categories');
Auth::routes();

// Route for Products Sidebar
Route::get('/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Auth::routes();


/**
 * CRUD Route for Category
 */ 

// Route for insert sub category.
Route::post('/category-insert', [CategoryController::class, 'insert'])->name('category-insert');

// Route for view a sub category.
Route::post('/category-read', [CategoryController::class, 'read'])->name('category-read');

// Route for update a sub category details.
Route::post('/category-update', [CategoryController::class, 'update'])->name('category-update');

// Route for delete a sub category.
Route::post('/category-delete', [CategoryController::class, 'delete'])->name('category-delete');


/**
 * CRUD Route for Sub Category
 */ 

// Route for insert sub category.
Route::post('/sub-category-insert', [SubCategoryController::class, 'insert'])->name('sub-category-insert');

// Route for view a sub category.
Route::post('/sub-category-read', [SubCategoryController::class, 'read'])->name('sub-category-read');

// Route for update a sub category details.
Route::post('/sub-category-update', [SubCategoryController::class, 'update'])->name('sub-category-update');

// Route for delete a sub category.
Route::post('/sub-category-delete', [SubCategoryController::class, 'delete'])->name('sub-category-delete');


/**
 * CRUD Route for Products
 */ 

// Route for insert products.
Route::post('/product-insert', [ProductController::class, 'insert'])->name('product-insert');

// Route for view a product.
Route::get('/product-read', [ProductController::class, 'read'])->name('product-read');

// Route for update a product details.
Route::put('/product-update', [ProductController::class, 'update'])->name('product-update');

// Route for delete a product.
Route::delete('/product-delete', [ProductController::class, 'delete'])->name('product-delete');