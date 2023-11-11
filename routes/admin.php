<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ChildCategoryController;

Route::get('auth/login', [AdminController::class, 'admin_login'])->name('login');

Route::post('login-action', [AdminController::class, 'login_action']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'prevent-back-history']  ], function () {

    Route::get('logout', [AdminController::class, 'logout']);
    Route::get('change-password', [AdminController::class, 'change_password']);
    Route::post('password-update', [AdminController::class, 'password_update']);
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('child-category', ChildCategoryController::class);
    Route::post('sub-category-search', [ChildCategoryController::class, 'sub_category_search'])->name('sub-category-search');
    Route::post('child-category-search', [ChildCategoryController::class, 'child_category_search'])->name('child-category-search');
    Route::resource('product', ProductController::class);
    Route::post('image-upload', [ProductController::class, 'image_upload'])->name('image-upload');
    Route::post('product-search', [ProductController::class, 'product_search'])->name('product-search');
    Route::resource('banner', BannerController::class);
    Route::resource('setting', SettingController::class); 
    Route::get('user', [AdminController::class, 'user']);
    Route::resource('order', OrderController::class);
    Route::post('order-status-update', [OrderController::class, 'order_status_update'])->name('order-status-update');
    Route::post('order-get-status', [OrderController::class, 'order_get_status'])->name('order-get-status');
    Route::get('notification', [OrderController::class, 'notification']);
    Route::get('notification-create', [OrderController::class, 'notification_create']);
    Route::post('notification-send', [OrderController::class, 'notification_send']);

});