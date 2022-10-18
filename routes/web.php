<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

////////
Route::get('/category-insert', [HomeController::class, 'categoryInsert'])->name('category-insert');
Route::get('/category-update', [HomeController::class, 'categoryUpdate'])->name('category-update');

Route::get('/sub-category-insert', [HomeController::class, 'subCategoryInsert'])->name('sub-category-insert');
Route::get('/sub-category-update', [HomeController::class, 'subCategoryUpdate'])->name('sub-category-update');

Route::get('/product-insert', [HomeController::class, 'productInsert'])->name('product-insert');
Route::get('/product-update', [HomeController::class, 'productUpdate'])->name('product-update');
///////////////


/**
 * CRUD Route for Category
 */ 

// Route for insert sub category.
Route::post('/c-insert', [CategoryController::class, 'insert'])->name('c-insert');

// Route for view a sub category.
Route::post('/c-read', [CategoryController::class, 'read'])->name('c-read');

// Route for update a sub category details.
Route::post('/c-update', [CategoryController::class, 'update'])->name('c-update');

// Route for delete a sub category.
Route::post('/c-delete', [CategoryController::class, 'delete'])->name('c-delete');


/**
 * CRUD Route for Sub Category
 */ 

// Route for insert sub category.
Route::post('/sc-insert', [SubCategoryController::class, 'insert'])->name('sc-inserct');

// Route for view a sub category.
Route::post('/sc-read', [SubCategoryController::class, 'read'])->name('sc-read');

// Route for update a sub category details.
Route::post('/sc-update', [SubCategoryController::class, 'update'])->name('sc-update');

// Route for delete a sub category.
Route::post('/sc-delete', [SubCategoryController::class, 'delete'])->name('sc-delete');


/**
 * CRUD Route for Products
 */ 

// Route for insert products.
Route::post('/p-insert', [ProductController::class, 'insert'])->name('p-insert');

// Route for view a product.
Route::post('/p-read', [ProductController::class, 'read'])->name('p-read');

// Route for update a product details.
Route::post('/p-update', [ProductController::class, 'update'])->name('p-update');

// Route for delete a product.
Route::post('/p-delete', [ProductController::class, 'delete'])->name('p-delete');


///////////////////
Route::view('/data', 'layouts.ecommerce.show_data');