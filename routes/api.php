<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{id}/show', [ProductApiController::class, 'show']);
Route::get('/product/create', [ProductApiController::class, 'create']);
Route::post('/product/store', [ProductApiController::class, 'store']);
Route::get('/product/edit', [ProductApiController::class, 'edit']);
Route::post('/product/{id}/update', [ProductApiController::class, 'update']);
Route::get('/product/{id}/delete', [ProductApiController::class, 'destroy']);
