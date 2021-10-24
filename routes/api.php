<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/products', [ProductController::class, 'showProducts']);
    Route::get('/products/{id}', [ProductController::class, 'getSingle']);
    Route::post('/products/create', [ProductController::class, 'createProducts']);
    Route::put('/products/update/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/products/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/logout', [authController::class, 'logout']);
    //Route::get('/logout', [authController::class, 'logout']);
});
// Public routes
Route::post('/register', [authController::class, 'registerUser']);
Route::post('/login', [authController::class, 'login']);
