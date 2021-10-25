<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])
    ->group(fn () => [
        Route::get('/', fn () => view('dashboard'))->name('dashboard'),

        Route::resource('product-categories', ProductCategoryController::class),
        Route::get('products/get-categories', [ProductController::class, 'getCategory'])->name('get-categories'),
        Route::resource('products', ProductController::class),
    ]);

require __DIR__.'/auth.php';
