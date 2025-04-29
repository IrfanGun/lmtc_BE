<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\ProductController;


// Route::get('/user', function (Request $request) {
    
// })->middleware('auth:sanctum');



Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('subcategory')->group(function () {
    Route::get('/', [SubCategoryController::class, 'index']);
    Route::get('/{id}', [SubCategoryController::class, 'show']);
    Route::post('/', [SubCategoryController::class, 'store']);
    Route::put('/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/{id}', [SubCategoryController::class, 'destroy']);
});

Route::prefix('states')->group(function () {
    Route::get('/', [StatesController::class, 'index']);
    Route::get('/{id}', [StatesController::class, 'show']);
    Route::post('/', [StatesController::class, 'store']);
    Route::put('/{id}', [StatesController::class, 'update']);
    Route::delete('/{id}', [StatesController::class, 'destroy']);
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

