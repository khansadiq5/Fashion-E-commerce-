<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

// Public user side routes
Route::get('/', [UserController::class, 'home']);

Route::get('collection', [UserController::class, 'allCollection']);

Route::get('about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('product/{id}', [UserController::class, 'productDetail']);

Route::middleware('auth')->group(function () {
    Route::post('cart/add/{id}', [UserController::class, 'addToCart']);
    Route::get('cart', [UserController::class, 'cart']);
    Route::put('cart/update/{id}', [UserController::class, 'updateQuantity']);
    Route::get('cart/remove/{id}', [UserController::class, 'removeItem']);
});

Route::middleware('auth')->group(function () {
    Route::get('checkout', [CheckoutController::class, 'checkout']);
    Route::post('checkout', [CheckoutController::class, 'placeOrder']);
    Route::get('order-success/{id}', [CheckoutController::class, 'orderSuccess']);
});

Route::middleware('auth')->group(function () {
    Route::get('my-orders', [OrderController::class, 'myOrders']);
    Route::get('my-orders/{id}', [OrderController::class, 'orderDetails']);
});

// Register
Route::view('register', 'register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');

// Login
Route::view('login', 'login')->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');

// Logout
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');

// Admin protected routes only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'dashboard']);

    // Category
    Route::get('admin/category', [AdminController::class, 'category']);
    Route::get('admin/category/add-category', function () {
        return view('add-category');
    });
    Route::post('admin/category/add-category', [AdminController::class, 'addCategory']);
    Route::get('admin/category/edit/{id}', [AdminController::class, 'showEditCategory']);
    Route::put('admin/category/edit-category/{id}', [AdminController::class, 'editCategory']);
    Route::get('admin/category/delete/{id}', [AdminController::class, 'deleteCategory']);

    // Product
    Route::get('admin/product', [AdminController::class, 'product']);
    Route::get('admin/product/add-product', [AdminController::class, 'showAddProduct']);
    Route::post('admin/product/add-product', [AdminController::class, 'addProduct']);
    Route::get('admin/product/edit/{id}', [AdminController::class, 'showEditProduct']);
    Route::put('admin/product/edit-product/{id}', [AdminController::class, 'editProduct']);
    Route::get('admin/product/delete/{id}', [AdminController::class, 'deleteProduct']);

    //Order
    Route::get('admin/orders', [AdminController::class, 'orders']);
    Route::get('admin/orders/{id}', [AdminController::class, 'orderDetails']);
    Route::put('admin/orders/status/{id}', [AdminController::class, 'updateOrderStatus']);
});