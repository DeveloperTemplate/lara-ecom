<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('category', [ApiController::class, 'category']);
Route::post('sub-category', [ApiController::class, 'sub_category']);
Route::post('child-category', [ApiController::class, 'child_category']);
Route::post('banner', [ApiController::class, 'banner']);
Route::post('product', [ApiController::class, 'product']);
Route::post('product-details', [ApiController::class, 'product_details']);
Route::post('search', [ApiController::class, 'search']);
Route::post('cart-view', [ApiController::class, 'cart_view']);
Route::post('cart-to-add', [ApiController::class, 'cart_add']);
Route::post('login', [ApiController::class, 'login']);
Route::post('resend-otp', [ApiController::class, 'resend_otp']);
Route::post('save-address', [ApiController::class, 'save_address']);
Route::post('update-address', [ApiController::class, 'update_address']);
Route::post('list-address', [ApiController::class, 'address_list']);
Route::post('check-address', [ApiController::class, 'address_check']);
Route::post('delete-address', [ApiController::class, 'address_delete']);
Route::post('order', [ApiController::class, 'order']);
Route::post('order-list', [ApiController::class, 'order_list']);
Route::post('order-details', [ApiController::class, 'order_details']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
 