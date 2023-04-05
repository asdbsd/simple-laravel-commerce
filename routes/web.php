<?php

use App\Http\Controllers\DashboardIndexController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
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
Route::get('/login', [LoginController::class, 'create'])->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Dashboard routes
Route::get('/dashboard', [DashboardIndexController::class, 'index'])->middleware('auth');

// Products index and show routes
Route::get('/store', [ProductsController::class, 'index']);
Route::get('/store/{product}', [ProductsController::class, 'show']);

// Dashboard Product routes
Route::get('/dashboard/my-products', [DashboardProductController::class, 'index'])->middleware('auth');
Route::get('/dashboard/add-product', [DashboardProductController::class, 'create'])->middleware('auth');
Route::post('/dashboard/add-product', [DashboardProductController::class, 'store'])->middleware('auth');
Route::get('/dashboard/edit-product/{product}', [DashboardProductController::class, 'edit'])->middleware('auth');
Route::patch('/dashboard/edit-product/{product}', [DashboardProductController::class, 'update'])->middleware('auth');
Route::delete('/dashboard/{product}', [DashboardProductController::class, 'destroy'])->middleware('auth');

