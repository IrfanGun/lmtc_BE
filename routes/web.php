<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    // return view('welcome');
});
Route::middleware(['web'])->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
});


Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [LoginController::class, 'user'])->middleware('auth:sanctum');
