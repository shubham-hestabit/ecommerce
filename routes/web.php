<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

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


Route::get('/category-index', [CategoryController::class, 'index'])->name('category-index');
// Auth::routes();

Route::view('/category', 'layouts.ecommerce.category.category_crud');

Route::post('/category-insert', [CategoryController::class, 'insert'])->name('category-insert');


Route::post('/category-read', [CategoryController::class, 'read'])->name('category-read');


Route::post('/category-update', [CategoryController::class, 'update'])->name('category-update');

Route::post('/category-delete', [CategoryController::class, 'delete'])->name('category-delete');