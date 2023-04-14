<?php

use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);



// Authentication Routes
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Products index and show routes
Route::get('/store', [ProductsController::class, 'index'])->name('store');
Route::get('/store/{product}', [ProductsController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/my-products', [DashboardProductController::class, 'index']);
    Route::get('/dashboard/add-product', [DashboardProductController::class, 'create']);
    Route::post('/dashboard/add-product', [DashboardProductController::class, 'store']);
    Route::get('/dashboard/edit-product/{product}', [DashboardProductController::class, 'edit']);
    Route::patch('/dashboard/edit-product/{product}', [DashboardProductController::class, 'update']);
    Route::delete('/dashboard/{product}', [DashboardProductController::class, 'destroy']);

    // Product favorites routes

    Route::get('/dashboard/favorites', [FavoritesController::class, 'index']);
    Route::post('/store/{product}/favorites', [FavoritesController::class, 'store'])->middleware('can:addFavorite,product');
    Route::delete('/store/{product}/favorites', [FavoritesController::class, 'destroy'])->middleware('can:removeFavorite,product');

    Route::get('/store/{product}/purchase', [PurchaseController::class, 'index']);
    Route::post('/store/{product}/purchase', [PurchaseController::class, 'index']);

});

// Dashboard Product routes


// Route::fallback(fn() => redirect('/store'));
