<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

// User Profile update Route
Route::get('user-profile', [HomeController::class, 'userProfile'])->name('user-profile');
Route::post('user-profile-update', [HomeController::class, 'updateUserProfile'])->name('update-user-profile');

/**
 * CRUD Route for Category Resource
 */
Route::resource('category', CategoryController::class);

/**
 * CRUD Routes for Sub Category Resource
 */
Route::resource('sub-category', SubCategoryController::class);
Route::get('/sub-category/create/{id}', [SubCategoryController::class, 'create'])->name('sc-create');

/**
 * CRUD Routes for Products Resource
 */
Route::resource('/product', ProductController::class);
Route::get('/product/create/{id}', [ProductController::class, 'create'])->name('product-create');

/**
 * CRUD Route for Shopping Cart Items
 */
Route::get('cart', [CartController::class, 'cartList'])->name('cart-list');
Route::post('save-cart', [CartController::class, 'addToCart'])->name('save-cart');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('update-cart');
Route::post('remove', [CartController::class, 'removeCart'])->name('remove-cart');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('clear-cart');

/**
 * Routes for Payment of Cart Items and genrate Invoice
 */
Route::get('payment', [PaymentController::class, 'index'])->name('payment');
Route::post('make-payment', [PaymentController::class, 'paymentDone'])->name('make-payment');
Route::get('refund-payment/{id}', [PaymentController::class, 'paymentRefund'])->name('refund-payment');
Route::get('payment-invoice/{id}', [PaymentController::class, 'paymentInvoice'])->name('payment-invoice');

/**
 * Routes for display Ordered items 
 */
Route::get('orders', [OrderController::class, 'orders'])->name('orders');
Route::get('item-invoice/{id}', [OrderController::class, 'orderInvoice'])->name('item-invoice');

/**
 * Routes for Subscription
 */
Route::get('subscription', [SubscriptionController::class, 'index']);
Route::post('subscription-payment', [SubscriptionController::class, 'subPayment'])->name('subscription-payment');
Route::post('subscribed', [SubscriptionController::class, 'addSubscription'])->name('subscribed');
Route::get('unsubscribed', [SubscriptionController::class, 'cancelSubscription'])->name('unsubscribed');

/**
 * Routes for Reset Password
 */
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');


//
Route::view('order-mail', 'layouts.ecommerce.payment.order_mail');