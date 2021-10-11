<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

// Route::get('/', function () {
//     return view('master.app');
// });
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/order', [OrderController::class, 'index'])->name('order');

Route::resource('user', UserController::class)->only(['index']);
Route::resource('category', CategoryController::class)->only(['index']);
Route::resource('product', ProductController::class)->only(['index']);
Route::resource('order', OrderController::class)->only(['index']);
