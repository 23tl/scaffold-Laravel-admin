<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\LoginController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api')
    ->group(function () {
        Route::get('captcha', [IndexController::class, 'captcha']);
        Route::prefix('auth')
            ->group(function () {
                Route::post('login', [LoginController::class, 'login']);
                Route::post('register', [LoginController::class, 'register']);
            });

        Route::middleware(['api.auth'])
            ->group(function () {
                Route::prefix('user')
                    ->group(function () {
                        Route::get('current', [UserController::class, 'current']);
                    });
            });
    });
