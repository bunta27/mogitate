<?php

use App\Http\Controllers\ProductsController;
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

Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('/products/register', [ProductsController::class, 'create'])->name('products.register');
Route::post('/products/register', [ProductsController::class, 'store'])->name('products.store');

Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');

Route::get('/products/{productId}', [ProductsController::class, 'show'])->name('products.detail');

Route::post('/products/{productId}/update', [ProductsController::class, 'update'])->name('products.update');
Route::post('/products/{productId}/delete', [ProductsController::class, 'destroy'])->name('products.delete');
