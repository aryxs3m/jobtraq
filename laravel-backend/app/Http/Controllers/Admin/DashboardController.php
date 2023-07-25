<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'listings' => JobListing::count(),
        ]);
    }
}
