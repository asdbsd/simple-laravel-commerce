<?php

use App\Http\Controllers\CartsController;
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

// Home page route
Route::resource('/', HomeController::class)
    ->only(['index']);

// Products index and show routes
Route::resource('products', ProductsController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function () {

    Route::resource('dashboard', DashboardProductController::class)
        ->parameters(['dashboard' => 'product'])
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('dashboard/favorites', [FavoritesController::class, 'index'])->name('dashboard.favorites.index');
    Route::post('dashboard/favorites/{product}', [FavoritesController::class, 'store'])->middleware('can:canManageFavorite,product')->name('dashboard.favorites.store');
    Route::delete('dashboard/favorites/{product}', [FavoritesController::class, 'destroy'])->middleware('can:canManageFavorite,product')->name('dashboard.favorites.destroy');

    // User Cart manage routes
    Route::get('/cart/{cart}', [CartsController::class, 'show'])->name('cart.index');
    Route::post('/cart/{cart}/{product}', [CartsController::class, 'store'])->middleware('can:canManageCart,cart,product')->name('cart.store');
    Route::patch('/cart/{cart}/{product}/{action}', [CartsController::class, 'update'])->middleware('can:canManageCart,cart,product')->name('cart.update');
    Route::delete('/cart/{cart}/{product}', [CartsController::class, 'destroy'])->middleware('can:canManageCart,cart,product')->name('cart.destroy');

    // Product purchase routes
    Route::get('/purchase/{cart}', [PurchaseController::class, 'index'])->middleware('can:canAccessPurchase,cart')->name('purchase.index');
    Route::post('/purchase/{cart}', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::get('/purchase/{cart}/complete', [PurchaseController::class, 'show'])->middleware('can:canAccessPurchase,cart')->name('purchase.complete');
});


Route::middleware('guest')->group(function () {
    // Authentication Routes
    Route::resource('login', LoginController::class)->only([
        'create', 'store'
    ]);

    Route::resource('register', RegisterController::class)->only([
        'create', 'store'
    ]);
});
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');



// Route::fallback(fn() => redirect('/store'));
