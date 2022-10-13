<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * CategoryController CRUD routes
 */

// Route for viewing all categories.
Route::get('/category-index', [CategoryController::class, 'index']);

// Route for insert categories.
Route::post('/category-insert', [CategoryController::class, 'insert']);

// Route for view a category.
Route::get('/category-read/{id}', [CategoryController::class, 'read']);

// Route for update a category.
Route::put('/category-update/{id}', [CategoryController::class, 'update']);

// Route for delete a category.
Route::delete('/category-delete/{id}', [CategoryController::class, 'delete']);



/**
 * SubCategoryController CRUD routes
 */

// Route for viewing all sub categories.
Route::get('/sub-category-index', [SubCategoryController::class, 'index']);

// Route for insert sub categories.
Route::post('/sub-category-insert', [SubCategoryController::class, 'insert']);

// Route for view a sub category.
Route::get('/sub-category-read/{id}', [SubCategoryController::class, 'read']);

// Route for update a sub category.
Route::put('/sub-category-update/{id}', [SubCategoryController::class, 'update']);

// Route for delete a sub category.
Route::delete('/sub-category-delete/{id}', [SubCategoryController::class, 'delete']);



/**
 * ProductController CRUD routes
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
