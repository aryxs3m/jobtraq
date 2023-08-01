<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Data\CountriesController;
use App\Http\Controllers\Admin\Data\LocationsController;
use App\Http\Controllers\Admin\JobLevelsController;
use App\Http\Controllers\Admin\JobListingsController;
use App\Http\Controllers\Admin\JobPositionsController;
use App\Http\Controllers\Admin\JobStacksController;
use App\Http\Controllers\Admin\ScraperKeywordsController;
use App\Http\Controllers\Admin\ScraperLogsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('scraper-keywords')->group(function () {
        Route::get('', [ScraperKeywordsController::class, 'index']);
        Route::get('add', [ScraperKeywordsController::class, 'create']);
        Route::get('edit/{crawlerKeyword}', [ScraperKeywordsController::class, 'update']);
        Route::post('add', [ScraperKeywordsController::class, 'upsertPost']);
        Route::post('edit/{crawlerKeyword}', [ScraperKeywordsController::class, 'upsertPost']);
        Route::get('delete/{crawlerKeyword}', [ScraperKeywordsController::class, 'delete']);
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

    Route::prefix('job-listings')->group(function () {
        Route::get('', [JobListingsController::class, 'index']);
        Route::get('reparse/{listing}', [JobListingsController::class, 'reparse']);
    });

    Route::prefix('data/countries')->group(function () {
        Route::get('', [CountriesController::class, 'index']);
        Route::get('add', [CountriesController::class, 'create']);
        Route::get('edit/{country}', [CountriesController::class, 'update']);
        Route::post('add', [CountriesController::class, 'upsertPost']);
        Route::post('edit/{country}', [CountriesController::class, 'upsertPost']);
        Route::get('delete/{country}', [CountriesController::class, 'delete']);
    });

    Route::prefix('data/locations')->group(function () {
        Route::get('', [LocationsController::class, 'index']);
        Route::get('add', [LocationsController::class, 'create']);
        Route::get('edit/{location}', [LocationsController::class, 'update']);
        Route::post('add', [LocationsController::class, 'upsertPost']);
        Route::post('edit/{location}', [LocationsController::class, 'upsertPost']);
        Route::get('delete/{location}', [LocationsController::class, 'delete']);
    });

    Route::prefix('scraper-logs')->group(function () {
        Route::get('', [ScraperLogsController::class, 'index']);
        Route::get('{log}', [ScraperLogsController::class, 'show']);
    });
});
