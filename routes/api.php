<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;

// User Routes
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);
Route::get('user/all/paginated', [UserController::class, 'getAllPaginated']);

// Store Routes
Route::get('store', [StoreController::class, 'index']);
Route::post('store', [StoreController::class, 'store']);
Route::get('/store/{id}', [StoreController::class, 'show']);
Route::put('store/{id}', [StoreController::class, 'update']);
Route::delete('store/{id}', [StoreController::class, 'destroy']);
Route::get('store/all/paginated', [StoreController::class, 'getAllPaginated']);
