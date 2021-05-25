<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NewsController;

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

Route::namespace('api')
    ->group(function () {
        Route::get('captcha', [IndexController::class, 'captcha']);
        Route::post('sms', [IndexController::class, 'sms']);
        Route::prefix('auth')
            ->group(function () {
                Route::post('login', [LoginController::class, 'login']);
                Route::post('register', [LoginController::class, 'register']);
            });

        Route::prefix('news')
            ->group(function () {
                Route::get('/', [NewsController::class, 'index']);
                Route::get('show', [NewsController::class, 'show']);
            });

        Route::middleware(['api.auth'])
            ->group(function () {
                Route::prefix('user')
                    ->group(function () {
                        Route::get('current', [UserController::class, 'current']);
                    });
            });
    });
