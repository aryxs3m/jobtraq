<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobListingsDataTable;
use App\Http\Controllers\Controller;
use App\Jobs\ReparseJob;
use App\Jobs\ScrapeJob;
use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class JobListingsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(JobListingsDataTable $dataTable)
    {
        $this->authorize('view listings');

        return $dataTable->render('job-listings.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function reparse(JobListing $listing, ReParserService $reParserService): RedirectResponse
    {
        $this->authorize('reparse listings');

        $reParserService->reparse($listing);

        return redirect()->back();
    }

    /**
     * @throws AuthorizationException
     */
    public function fullReparse(): RedirectResponse
    {
        $this->authorize('reparse listings');

        ReparseJob::dispatch();

        return redirect()->back()->with(
            'success',
            'Reparse job elindult. Értesítve leszel Discordon, ha befejeződött.'
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function scrape(): RedirectResponse
    {
        $this->authorize('scrape listings');

        ScrapeJob::dispatch();

        return redirect()->back()->with(
            'success',
            'Scrape job elindult. Értesítve leszel Discordon, ha befejeződött.'
        );
    }
}
