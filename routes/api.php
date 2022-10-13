<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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
Route::get('/index', [CategoryController::class, 'index']);

// Route for insert categories.
Route::post('/insert', [CategoryController::class, 'insert']);

// Route for read a category.
Route::get('/read/{id}', [CategoryController::class, 'read']);

// Route for update a category.
Route::put('/update/{id}', [CategoryController::class, 'update']);

// Route for delete a category.
Route::delete('/delete/{id}', [CategoryController::class, 'delete']);



/**
 * SubCategoryController CRUD routes
 */

// Route for viewing all sub categories.
Route::get('/sc-index', [SubCategoryController::class, 'index']);

// Route for insert sub categories.
Route::post('/sc-insert', [SubCategoryController::class, 'insert']);

// Route for read a sub category.
Route::get('/sc-read/{id}', [SubCategoryController::class, 'read']);

// Route for update a sub category.
Route::put('/sc-update/{id}', [SubCategoryController::class, 'update']);

// Route for delete a sub category.
Route::delete('/sc-delete/{id}', [SubCategoryController::class, 'delete']);