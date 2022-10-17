<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\Product;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/category', [App\Http\Controllers\HomeController::class, 'index'])->name('category');

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

Route::view('/category', 'layouts.ecommerce.category_crud');
Route::get('/category-index', [CategoryController::class, 'index'])->name('category-index');//remove
Route::view('/sub-category', 'layouts.ecommerce.sub_category_crud');
Route::view('/product', 'layouts.ecommerce.product_crud');


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

// Route for viewing all products.
Route::get('/product-index', [ProductController::class, 'index']);

// Route for insert products.
Route::post('/product-insert', [ProductController::class, 'insert']);

// Route for view a product.
Route::get('/product-read/{id}', [ProductController::class, 'read']);

// Route for update a product details.
Route::put('/product-update/{id}', [ProductController::class, 'update']);

// Route for delete a product.
Route::delete('/product-delete/{id}', [ProductController::class, 'delete']);