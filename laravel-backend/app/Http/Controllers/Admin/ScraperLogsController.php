<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScraperLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ScraperLog;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ScraperLogsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(ScraperLogsDataTable $dataTable)
    {
        $this->authorize('view scraper-logs');

        return $dataTable->render('scraper-logs.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function show(ScraperLog $log): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view scraper-logs');

        return view('scraper-logs.show', compact('log'));
    }
}
