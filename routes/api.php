<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisasterController;
use App\Http\Controllers\DisasterProgramCategoryController;
use App\Http\Controllers\DisasterProgramController;
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

    Route::apiResource('disasters', DisasterController::class)->names([
        'index' => 'disasters.index',
        'store' => 'disasters.store',
        'show' => 'disasters.show',
        'update' => 'disasters.update',
        'destroy' => 'disasters.destroy',
    ]);

    Route::apiResource('disaster-programs', DisasterProgramController::class)->names([
        'index' => 'disaster-programs.index',
        'store' => 'disaster-programs.store',
        'show' => 'disaster-programs.show',
        'update' => 'disaster-programs.update',
        'destroy' => 'disaster-programs.destroy',
    ]);

    Route::apiResource('disaster-program-categories', DisasterProgramCategoryController::class)->names([
        'index' => 'disaster-program-categories.index',
        'store' => 'disaster-program-categories.store',
        'show' => 'disaster-program-categories.show',
        'update' => 'disaster-program-categories.update',
        'destroy' => 'disaster-program-categories.destroy',
    ]);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
            Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
        });
    });
});
