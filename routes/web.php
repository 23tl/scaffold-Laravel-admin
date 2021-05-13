<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {
        Route::get('login', [LoginController::class, 'loginShow'])->name('login.show');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        Route::middleware('auth')
            ->group(function () {
                Route::get('/', [IndexController::class, 'index'])->name('index');
                Route::get('welcome', [IndexController::class, 'welcome'])->name('welcome');
                Route::get('nav', [IndexController::class, 'nav'])->name('nav');
                Route::get('logout', [LoginController::class, 'logout'])->name('logout');

                /**
                 * 管理员
                 */
                Route::prefix('account')
                    ->name('account.')
                    ->group(function () {
                        Route::get('/', [AccountController::class, 'index'])->name('index');
                        Route::get('create', [AccountController::class, 'create'])->name('create');
                        Route::get('edit/{id}', [AccountController::class, 'edit'])->name('edit');
                        Route::post('store', [AccountController::class, 'store'])->name('store');
                        Route::post('update', [AccountController::class, 'update'])->name('update');
                        Route::post('destroy', [AccountController::class, 'destroy'])->name('destroy');
                    });

                /**
                 * 角色
                 */
                Route::prefix('roles')
                     ->name('roles.')
                     ->group(function () {
                         Route::get('/', [RolesController::class, 'index'])->name('index');
                         Route::get('create', [RolesController::class, 'create'])->name('create');
                         Route::get('edit/{id}', [RolesController::class, 'edit'])->name('edit');
                         Route::post('store', [RolesController::class, 'store'])->name('store');
                         Route::post('update', [RolesController::class, 'update'])->name('update');
                         Route::post('destroy', [RolesController::class, 'destroy'])->name('destroy');
                     });

                /**
                 * 菜单
                 */
                Route::prefix('menus')
                    ->name('menus.')
                    ->group(function () {
                        Route::get('/', [MenusController::class, 'index'])->name('index');
                        Route::get('create', [MenusController::class, 'create'])->name('create');
                        Route::get('edit/{id}', [MenusController::class, 'edit'])->name('edit');
                        Route::post('store', [MenusController::class, 'store'])->name('store');
                        Route::post('update', [MenusController::class, 'update'])->name('update');
                        Route::post('destroy', [MenusController::class, 'destroy'])->name('destroy');
                    });

                /**
                 * 分类
                 */
                Route::prefix('category')
                    ->name('category.')
                    ->group(function () {
                        Route::get('/', [CategoryController::class, 'index'])->name('index');
                        Route::get('create', [CategoryController::class, 'create'])->name('create');
                        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
                        Route::post('store', [CategoryController::class, 'store'])->name('store');
                        Route::post('update', [CategoryController::class, 'update'])->name('update');
                        Route::post('destroy', [CategoryController::class, 'destroy'])->name('destroy');
                    });
            });
    });