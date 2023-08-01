<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Services\Report\AdminReporter;

class DashboardController extends Controller
{
    public function index(AdminReporter $reporter)
    {
        $notUsedListings = $reporter->getJobListingCountNotUsed();
        $totalListings = JobListing::count();

        try {
            $percentageNotUsed = number_format(
                $notUsedListings / $totalListings * 100,
                1,
                ',',
                ' '
            );
        } catch (\DivisionByZeroError $error) {
            $percentageNotUsed = '0';
        }

        return view('welcome', [
            'countListings' => $totalListings,
            'countListingsToday' => $reporter->getJobListingCountToday(),
            'countListingsNotUsed' => $notUsedListings,
            'countListingsFull' => $reporter->getJobListingCountFull(),
            'jobListingsDaily' => $reporter->getJobListingsDaily()->values(),
            'jobListingsCrawler' => $reporter->getJobListingsByCrawler(),
            'percentageOfNotUsedListings' => $percentageNotUsed,
            'errorsToday' => $reporter->errorCountToday(),
        ]);
    }
}
