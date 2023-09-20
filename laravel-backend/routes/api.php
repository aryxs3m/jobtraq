<?php

use App\Http\Controllers\PublicApi\ArticlesController;
use App\Http\Controllers\PublicApi\CommentsController;
use App\Http\Controllers\PublicApi\HealthcheckController;
use App\Http\Controllers\PublicApi\HomeController;
use App\Http\Controllers\PublicApi\Integrations\HomeAssistantController;
use App\Http\Controllers\PublicApi\Reports\DiffReportController;
use App\Http\Controllers\PublicApi\Reports\ReportController;
use App\Http\Controllers\PublicApi\SubscribeController;
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
    Route::get('diff', [DiffReportController::class, 'diffReport']);
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

Route::prefix('subscribe')->group(function () {
    Route::middleware('throttle:subscriptions')->group(function () {
        Route::post('/discord', [SubscribeController::class, 'subscribeDiscord']);
    });
});

Route::prefix('integrations')->group(function () {
    Route::get('/homeassistant', [HomeAssistantController::class, 'getSensor']);
});
