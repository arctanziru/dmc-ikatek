<?php

use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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
});
