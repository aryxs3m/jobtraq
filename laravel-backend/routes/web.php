<?php

use App\Http\Controllers\Admin\CrawlerKeywordsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobLevelsController;
use App\Http\Controllers\Admin\JobPositionsController;
use App\Http\Controllers\Admin\JobStacksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::prefix('crawler-keywords')->group(function () {
    Route::get('', [CrawlerKeywordsController::class, 'index']);
    Route::get('add', [CrawlerKeywordsController::class, 'create']);
    Route::get('edit/{crawlerKeyword}', [CrawlerKeywordsController::class, 'update']);
    Route::post('add', [CrawlerKeywordsController::class, 'upsertPost']);
    Route::post('edit/{crawlerKeyword}', [CrawlerKeywordsController::class, 'upsertPost']);
    Route::get('delete/{crawlerKeyword}', [CrawlerKeywordsController::class, 'delete']);
});

Route::prefix('job-positions')->group(function () {
    Route::get('', [JobPositionsController::class, 'index']);
    Route::get('add', [JobPositionsController::class, 'create']);
    Route::get('edit/{jobPosition}', [JobPositionsController::class, 'update']);
    Route::post('add', [JobPositionsController::class, 'upsertPost']);
    Route::post('edit/{jobPosition}', [JobPositionsController::class, 'upsertPost']);
    Route::get('delete/{jobPosition}', [JobPositionsController::class, 'delete']);
});

Route::prefix('job-levels')->group(function () {
    Route::get('', [JobLevelsController::class, 'index']);
    Route::get('add', [JobLevelsController::class, 'create']);
    Route::get('edit/{jobLevel}', [JobLevelsController::class, 'update']);
    Route::post('add', [JobLevelsController::class, 'upsertPost']);
    Route::post('edit/{jobLevel}', [JobLevelsController::class, 'upsertPost']);
    Route::get('delete/{jobLevel}', [JobLevelsController::class, 'delete']);
    Route::get('order', [JobLevelsController::class, 'order']);
    Route::post('order', [JobLevelsController::class, 'orderPost']);
});

Route::prefix('job-stacks')->group(function () {
    Route::get('', [JobStacksController::class, 'index']);
    Route::get('add', [JobStacksController::class, 'create']);
    Route::get('edit/{jobStack}', [JobStacksController::class, 'update']);
    Route::post('add', [JobStacksController::class, 'upsertPost']);
    Route::post('edit/{jobStack}', [JobStacksController::class, 'upsertPost']);
    Route::get('delete/{jobStack}', [JobStacksController::class, 'delete']);
});
