<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/generate-token', [AuthController::class, 'generate_token']);
Route::post('auth/refresh-token', [AuthController::class, 'refresh_token']);
Route::post('auth/logout-token', [AuthController::class, 'logout_token']);

Route::group(['middleware' => ['apiJwt']], function () {
    Route::post('auth/authenticated-user-token', [AuthController::class, 'me']);

    Route::get('status', [StatusController::class, 'getStatus']);
    Route::post('status', [StatusController::class, 'createStatus']);

    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('users/{id}', [UserController::class, 'getUserById']);
    Route::post('users', [UserController::class, 'createUser']);
    Route::put('users/{id}', [UserController::class, 'putUserById']);
    Route::delete('users/{id}', [UserController::class, 'removeUserById']);

    Route::post('categories', [CategoryController::class, 'createCategory']);

    Route::get('products', [ProductController::class, 'getProducts']);
    Route::get('products/{id}', [ProductController::class, 'getProductById']);
    Route::post('products', [ProductController::class, 'createProduct']);
    Route::post('products/put/{id}', [ProductController::class, 'putProductById']);
    Route::post('products/patch/{id}', [ProductController::class, 'patchUserById']);
    Route::delete('products/{id}', [ProductController::class, 'removeProductById']);
});
