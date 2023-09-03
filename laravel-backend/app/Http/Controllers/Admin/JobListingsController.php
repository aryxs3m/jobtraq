<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobListingsDataTable;
use App\Http\Controllers\Controller;
use App\Jobs\ReparseJob;
use App\Jobs\ScrapeJob;
use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Illuminate\Http\RedirectResponse;

class JobListingsController extends Controller
{
    public function index(JobListingsDataTable $dataTable)
    {
        return $dataTable->render('job-listings.list');
    }

    public function reparse(JobListing $listing, ReParserService $reParserService): RedirectResponse
    {
        $reParserService->reparse($listing);

        return redirect()->back();
    }

    public function fullReparse(): RedirectResponse
    {
        ReparseJob::dispatch();

        return redirect()->back()->with(
            'success',
            'Reparse job elindult. Értesítve leszel Discordon, ha befejeződött.'
        );
    }

    public function scrape(): RedirectResponse
    {
        ScrapeJob::dispatch();

        return redirect()->back()->with(
            'success',
            'Scrape job elindult. Értesítve leszel Discordon, ha befejeződött.'
        );
    }
}
