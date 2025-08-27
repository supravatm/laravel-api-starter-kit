<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CarrierController;
use App\Http\Controllers\Api\OrderController;

Route::get('/hello', function (Request $request) {
    return ['msg' => "Hello API!", 'code'=> 200];
});
Route::post('register', [AuthController::class, 'register']);
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('products', ProductController::class);
    Route::get('products/{order_id}', [ProductController::class, 'show']);    
    Route::get('carrier/{carrier_id}/collections', [CarrierController::class, 'getCollections']);
    Route::put('carrier/{order_id}/collect', [CarrierController::class, 'collect']);
    Route::get('order/{order_id}', [OrderController::class, 'show']);
    Route::get('order/{carrier_id}/collection', [OrderController::class, 'getCollections']);
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
    Route::put('/orders/{order_id}/collect', [OrderController::class, 'collect']);
});