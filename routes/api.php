<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('news', NewsController::class)->names([
        'index' => 'news.index',
        'store' => 'news.store',
        'show' => 'news.show',
        'update' => 'news.update',
        'destroy' => 'news.destroy',
    ]);

    Route::apiResource('news-category', NewsCategoryController::class)->names([
        'index' => 'news-category.index',
        'store' => 'news-category.store',
        'show' => 'news-category.show',
        'update' => 'news-category.update',
        'destroy' => 'news-category.destroy',
    ]);

    Route::apiResource('user', UserController::class)->names([
        'index' => 'user.index',
        'store' => 'user.store',
        'show' => 'user.show',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ]);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    });
});
