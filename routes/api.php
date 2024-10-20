<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(App\Http\Controllers\AuthController::class)->prefix('auth')->middleware(['api'])->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    Route::post('/me', 'me');
});

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->middleware(['jwt.auth', 'admin'])->group(function () {
    Route::namespace('Category')->prefix('categories')->group(function () {
        Route::get('/', IndexController::class)->name('admin.category.index');
        Route::get('/{category}', ShowController::class)->name('admin.category.show');
        Route::post('/', StoreController::class)->name('admin.category.store');
        Route::patch('/{category}', UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', DestroyController::class)->name('admin.category.destroy');
    });

    Route::namespace('Product')->prefix('products')->group(function () {
        Route::get('/', IndexController::class)->name('admin.product.index');
        Route::get('/{product}', ShowController::class)->name('admin.product.show');
        Route::post('/', StoreController::class)->name('admin.product.store');
        Route::patch('/{product}', UpdateController::class)->name('admin.product.update');
        Route::delete('/{product}', DestroyController::class)->name('admin.product.destroy');
    });

    Route::namespace('user')->prefix('users')->group(function () {
        Route::get('/roles', RolesController::class)->name('admin.user.roles');
        Route::get('/', IndexController::class)->name('admin.user.index');
        Route::get('/{user}', ShowController::class)->name('admin.user.show');
        Route::post('/', StoreController::class)->name('admin.user.store');
        Route::patch('/{user}', UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', DestroyController::class)->name('admin.user.destroy');
    });

//    Route::namespace('Review')->prefix('reviews')->group(function () {
//        Route::get('/', IndexController::class)->name('admin.review.index');
//        Route::get('/{review}', ShowController::class)->name('admin.review.show');
//        Route::post('/', StoreController::class)->name('admin.review.store');
//        Route::patch('/{review}', UpdateController::class)->name('admin.review.update');
//        Route::delete('/{review}', DestroyController::class)->name('admin.review.destroy');
//    });
});

Route::namespace('App\Http\Controllers\User')->prefix('users')->group(function () {
    Route::post('/', StoreController::class)->name('user.store');
});

Route::namespace('App\Http\Controllers\Product')->prefix('products')->group(function () {
    Route::get('/latest', LatestController::class)->name('product.latest');
    Route::get('/popular', PopularController::class)->name('product.popular');
});

Route::namespace('App\Http\Controllers\Favorited')->middleware('jwt.auth')->prefix('favorites')->group(function () {
    Route::get('/', UsersItemsController::class)->name('favorited.users');
    Route::post('/{product}', StoreController::class)->name('favorited.store');
    Route::delete('/{product}', DestroyController::class)->name('favorited.destroy');
});

Route::namespace('App\Http\Controllers\Cart')->middleware('jwt.auth')->prefix('cart')->group(function () {
    Route::get('/', UsersItemsController::class)->name('cart.users');
    Route::post('/{product}', StoreController::class)->name('cart.store');
    Route::patch('/{product}', UpdateController::class)->name('cart.update');
    Route::delete('/{product}', DestroyController::class)->name('cart.destroy');
});

