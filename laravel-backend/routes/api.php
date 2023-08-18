<?php

use App\Http\Controllers\PublicApi\ArticlesController;
use App\Http\Controllers\PublicApi\CommentsController;
use App\Http\Controllers\PublicApi\HealthcheckController;
use App\Http\Controllers\PublicApi\HomeController;
use App\Http\Controllers\PublicApi\ReportController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/healthcheck', [HealthcheckController::class, 'status']);

Route::prefix('report')->group(function () {
    Route::get('homepage', [ReportController::class, 'homepageStatistics']);
    Route::get('by-position', [ReportController::class, 'statisticByPosition']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticlesController::class, 'list']);
    Route::get('/get', [ArticlesController::class, 'get']);
});

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentsController::class, 'getComments']);

    Route::middleware('throttle:new-comments')->group(function () {
        Route::post('/new', [CommentsController::class, 'newComment']);
    });
});
