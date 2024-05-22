<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;

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
    Route::get('users', [UserController::class, 'getUsers']);
    Route::post('user/create', [UserController::class, 'createUser']);
    Route::get('user/{id}', [UserController::class, 'getUserById']);
    Route::put('user/edit/{id}', [UserController::class, 'putUserById']);
    Route::delete('user/delete/{id}', [UserController::class, 'removeUserById']);
});
