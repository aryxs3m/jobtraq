<?php

namespace App\Services\Report;

use App\Models\ScraperLog;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminReporter
{
    public function getJobListingCountToday(): int
    {
        return DB::table('job_listings')
            ->select(DB::raw('COUNT(id) AS value'))
            ->whereRaw("DATE(created_at) = :filterDate", ['filterDate' => (new Carbon())->format('Y-m-d')])
            ->get()
            ->first()
            ->value;
    }

    public function getJobListingCountNotUsed(): int
    {
        return DB::table('job_listings')
            ->select(DB::raw('COUNT(id) AS value'))
            ->where('stack', '=', null)
            ->where('position', '=', null)
            ->where('level', '=', null)
            ->get()
            ->first()
            ->value;
    }

    public function getJobListingCountFull(): int
    {
        return DB::table('job_listings')
            ->select(DB::raw('COUNT(id) AS value'))
            ->where('stack', '<>', null)
            ->where('position', '<>', null)
            ->where('level', '<>', null)
            ->get()
            ->first()
            ->value;
    }

    public function getJobListingsDaily(): Collection
    {
        return DB::table('job_listings')
            ->select(DB::raw('DATE(created_at) AS created_date'), DB::raw('COUNT(id) AS value'))
            ->groupBy('created_date')
            ->orderBy('created_date', 'DESC')
            ->limit(30)
            ->get()
            ->reverse();
    }

    public function getJobListingsByCrawler(): Collection
    {
        return DB::table('job_listings')
            ->select('crawler', DB::raw('COUNT(id) AS value'))
            ->groupBy('crawler')
            ->orderBy('crawler', 'ASC')
            ->get();
    }

    public function errorCountToday(): int
    {
        return ScraperLog::query()
            ->whereDate('created_at', '=', Carbon::now())
            ->count();
    }
}
