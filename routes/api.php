<?php


use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('add-product', [CartController::class, 'addProduct']);
    Route::post('remove-product', [CartController::class, 'removeProduct']);
    Route::post('set-quantity', [CartController::class, 'setQuantity']);
    Route::get('cart', [CartController::class, 'index']);
});
