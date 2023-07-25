<?php

namespace App\Services\Report;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PublicReporter
{
    public function getAverageSalariesByPositions(): Collection
    {
        return DB::table('job_listings')
            ->select('position', 'level', DB::raw('AVG(salary_low) AS low_avg'), DB::raw('AVG(salary_high) AS high_avg'))
            ->whereRaw("position IS NOT NULL AND position <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó')")
            ->groupBy('position', 'level')
            ->orderBy('position')
            ->get();
    }
}
