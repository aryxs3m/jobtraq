<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobListingsDataTable;
use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Illuminate\Http\Request;

class JobListingsController extends Controller
{
    public function index(JobListingsDataTable $dataTable)
    {
        return $dataTable->render('job-listings.list');
    }

    public function reparse(JobListing $listing, ReParserService $reParserService)
    {
        $reParserService->reparse($listing);

        return redirect()->back();
    }
}
