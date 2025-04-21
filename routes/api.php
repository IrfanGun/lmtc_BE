<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', function () {
    return response()->json([
        'categories' => [
            [
                'id' => 1,
                'name' => 'Electronics',
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'name' => 'Furniture',
                'is_featured' => false,
            ],
            [
                'id' => 3,
                'name' => 'Clothing',
                'is_featured' => true,
            ],
        ],
    ]);
});