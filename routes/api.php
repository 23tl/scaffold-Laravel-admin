<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Payment\PayController;
use App\Http\Controllers\Payment\NotifyController;
use App\Http\Controllers\Api\FundLogsController;

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
        Route::get('banner', [BannerController::class, 'index']);
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
                Route::prefix('logs')
                    ->group(function () {
                        Route::get('fund', [FundLogsController::class, 'index']);
                    });
            });
    });

Route::namespace('payment')
    ->prefix('payment')
    ->group(function () {
        Route::post('pay', [PayController::class, 'pay'])->middleware(['api.auth']);
        Route::prefix('notify')
            ->group(function () {
                Route::any('alipay', [NotifyController::class, 'alipay']);
                Route::any('wechat', [NotifyController::class, 'wechat']);
            });
    });


