<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\SaleController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\FavoriteController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\MaintenanceController;
use App\Http\Controllers\Web\HistoryOrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        Route::group([], function () {
            // home
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/register', [RegisterController::class, 'index'])
                ->name('view_register');

            Route::post('/register', [RegisterController::class, 'store'])
                ->name('register');
            Route::get('/login', [LoginController::class, 'index'])
                ->name('view_login');
            Route::post('/login', [LoginController::class, 'store'])
                ->name('login');
            Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
            Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
            Route::get('/sales', [SaleController::class, 'index'])->name('sales');
            Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
            Route::get('/products/{id}', [HomeController::class, 'detail'])->name('products.detail');
            // Route::get('/products/search', [HomeController::class, 'search'])->name('products.search');

        });

        Route::group(['middleware' => ['auth']], function () {
            Route::resources([
                'carts' => CartController::class,
            ]);
            Route::put('update_cart/{id}', [CartController::class, 'update_carts']);
            Route::post('/carts/store', [CartController::class, 'store'])->name('carts.store');

            Route::get('total', [CartController::class, 'total'])->name('carts.total');
            Route::get('flush', [CartController::class, 'flush'])->name('carts.flush');
            Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
            Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
            Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
            Route::post('favorites/store', [FavoriteController::class, 'store'])->name('favorites.store');
            Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.delete');
            Route::post('order', [OrderController::class, 'store'])->name('order.store');
            Route::get('history_order', [HistoryOrderController::class, 'index'])->name('history_order.index');
            Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        });
    });

require __DIR__ . '/dashboard.php';
