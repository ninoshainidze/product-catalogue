<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('add-product', [CartController::class, 'addProduct']);
    Route::post('remove-product', [CartController::class, 'removeProduct']);
    Route::post('set-quantity', [CartController::class, 'setProductQuantity']);
    Route::get('cart', [CartController::class, 'getCart']);
});
