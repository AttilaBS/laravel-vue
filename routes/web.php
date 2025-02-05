<?php

use App\Http\Controllers\Authentication\LoginUserController;
use App\Http\Controllers\Authentication\LogoutUserController;
use App\Http\Controllers\Authentication\StoreUserController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\EditProductController;
use App\Http\Controllers\Product\ListProductsController;
use App\Http\Controllers\Product\SearchProductsController;
use App\Http\Controllers\Product\StoreProductController;
use App\Http\Controllers\Product\UpdateProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('user.')->prefix('user')
    ->group(
        function (): void {
            Route::get('/create', function () {
                return Inertia::render('User/Create');
            })->name('create-page');
            Route::get('/login', function () {
                return Inertia::render('User/Login');
            })->name('login-page');
            Route::post('/create', StoreUserController::class)
                ->name('create');
            Route::post('/login', LoginUserController::class)
                ->name('login');
            Route::middleware('auth')->group(function (): void {
                Route::post('/logout', LogoutUserController::class)
                ->name('logout');
            });
        }
    );

Route::middleware('auth')->group(function (): void {
    Route::get('/', ListProductsController::class)
        ->name('home');
    Route::name('product.')->prefix('product')
        ->group(
            function (): void {
                Route::get('/create', CreateProductController::class)
                    ->name('create');
                Route::get('/edit', EditProductController::class)
                    ->name('edit');
                Route::get('/search', SearchProductsController::class)
                    ->name('search');
                Route::post('/store', StoreProductController::class)
                    ->name('store');
                Route::put('/update/{uuid}', UpdateProductController::class)
                    ->name('update');
                Route::delete('/delete/{uuid}', DeleteProductController::class)
                    ->name('delete');
            }
        );
    }
);
