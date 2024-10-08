<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function () {
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
});
