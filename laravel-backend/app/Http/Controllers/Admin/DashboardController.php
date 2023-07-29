<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Services\Report\AdminReporter;

class DashboardController extends Controller
{
    public function index(AdminReporter $reporter)
    {
        return view('welcome', [
            'countListings' => JobListing::count(),
            'countListingsToday' => $reporter->getJobListingCountToday(),
            'countListingsNotUsed' => $reporter->getJobListingCountNotUsed(),
            'countListingsFull' => $reporter->getJobListingCountFull(),
            'jobListingsDaily' => $reporter->getJobListingsDaily(),
            'jobListingsCrawler' => $reporter->getJobListingsByCrawler(),
        ]);
    }
}
