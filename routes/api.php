<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/users', [UserController::class, 'createUser']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('jwt.auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'getUsers']);
            Route::get('/{id}', [UserController::class, 'getUserById']);
            Route::put('/{id}', [UserController::class, 'updateUser']);
            Route::delete('/{id}', [UserController::class, 'deleteUser']);
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'getProducts']);
            Route::get('/{id}', [ProductController::class, 'getProductById']);
            Route::post('/', [ProductController::class, 'createProduct']);
            Route::put('/{id}', [ProductController::class, 'updateProduct']);
            Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
        });
    });
});
