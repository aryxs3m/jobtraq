<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobListingsDataTable;
use App\DataTables\ScraperLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\ScraperLog;
use App\Services\Parser\ReParserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ScraperLogsController extends Controller
{
    public function index(ScraperLogsDataTable $dataTable)
    {
        return $dataTable->render('scraper-logs.list');
    }

    public function show(ScraperLog $log): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('scraper-logs.show', compact('log'));
    }
}
