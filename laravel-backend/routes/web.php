<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Data\CountriesController;
use App\Http\Controllers\Admin\Data\LocationsController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\JobLevelsController;
use App\Http\Controllers\Admin\JobListingsController;
use App\Http\Controllers\Admin\JobPositionsController;
use App\Http\Controllers\Admin\JobStacksController;
use App\Http\Controllers\Admin\ScraperKeywordsController;
use App\Http\Controllers\Admin\ScraperLogsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'scraper-keywords' => ScraperKeywordsController::class,
        'job-positions' => JobPositionsController::class,
        'job-levels' => JobLevelsController::class,
        'job-stacks' => JobStacksController::class,
        'data/countries' => CountriesController::class,
        'data/locations' => LocationsController::class,
        'articles' => ArticlesController::class,
        'images' => ImageController::class,
    ]);

    Route::post('/images/editor-upload', [ImageController::class, 'editorImageUpload'])
        ->name('images.editor-upload');

    Route::prefix('job-level-order')->name('job-level-order.')->group(function () {
        Route::get('', [JobLevelsController::class, 'order'])->name('order');
        Route::post('', [JobLevelsController::class, 'orderPost'])->name('order-post');
    });

    Route::prefix('job-listings')->name('job-listings.')->group(function () {
        Route::get('', [JobListingsController::class, 'index'])->name('index');
        Route::get('reparse/{listing}', [JobListingsController::class, 'reparse'])->name('reparse');
    });

    Route::prefix('scraper-logs')->name('scraper-logs.')->group(function () {
        Route::get('', [ScraperLogsController::class, 'index'])->name('index');
        Route::get('{log}', [ScraperLogsController::class, 'show'])->name('show');
    });

    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('', [CommentsController::class, 'listComments'])->name('index');
        Route::post('update-moderation', [CommentsController::class, 'updateCommentStatus'])
            ->name('update-moderation');
        Route::post('update-op', [CommentsController::class, 'updateCommentOpStatus'])
            ->name('update-op');
    });
});
