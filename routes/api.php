<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

// Group product-related routes under 'products' prefix
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); // List products
    Route::post('/', [ProductController::class, 'store']); // Create product
    Route::get('{id}', [ProductController::class, 'show']); // Show product or user products
    Route::put('{id}', [ProductController::class, 'update']); // Update product
    Route::delete('{id}', [ProductController::class, 'destroy']); // Delete product
});

// Get paginated products for a specific category
Route::get('categories/{id}/products', [CategoryController::class, 'products']);
// Get all categories
Route::get('categories', [CategoryController::class, 'index']);

// User authentication route for login
Route::post('/auth/login', [AuthController::class, 'login']);
// User authentication route for logout (token required)
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    //
});
// Get all products for a specific user
Route::get('user/{user_id}/products', [ProductController::class, 'userProducts']);

// ProductController.php
