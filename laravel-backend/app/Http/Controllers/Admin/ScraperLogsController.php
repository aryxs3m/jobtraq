<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScraperLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ScraperLog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

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
