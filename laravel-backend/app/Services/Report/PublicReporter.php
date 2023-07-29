<?php

namespace App\Services\Report;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PublicReporter
{
    public function getJobsCountByPosition(): Collection
    {
        return DB::table('job_listings')
            ->select('position AS name', DB::raw('COUNT(id) AS value'))
            ->whereRaw("position IS NOT NULL AND position <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó')")
            ->groupBy('position')
            ->orderBy('value', 'DESC')
            ->get();
    }

    public function getJobsCountByWeek(): Collection
    {
        return DB::table('job_listings')
            ->select(DB::raw('WEEK(created_at, 7) AS name'), DB::raw('COUNT(id) AS value'))
            ->whereRaw("position IS NOT NULL AND position <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó')")
            ->groupBy(DB::raw('WEEK(created_at, 7)'))
            ->orderBy('name', 'DESC')
            ->limit(4)
            ->get()
            ->reverse();
    }

    public function getJobsCountByStack(): Collection
    {
        return DB::table('job_listings')
            ->select('stack AS name', DB::raw('COUNT(id) AS value'))
            ->whereRaw("stack IS NOT NULL AND stack <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó')")
            ->groupBy('stack')
            ->orderBy('value', 'DESC')
            ->get();
    }

    public function getAverageSalariesByLevels(string $position): Collection
    {
        // TODO: order by level 'order' column
        return DB::table('job_listings')
            ->select('level AS name', DB::raw('AVG(salary_low) AS value'))
            ->whereRaw("position IS NOT NULL AND position <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó')")
            ->where('position', '=', $position)
            ->groupBy('level')
            ->orderBy('level')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'value' => (int) $item->value,
                ];
            });
    }

    public function getAverageSalariesByStacksByLevels(): array
    {
        $collection = DB::table('job_listings')
            ->select('level', 'stack', DB::raw('AVG(salary_low) AS value'))
            ->whereRaw("position IS NOT NULL AND position <> '' AND level IS NOT NULL AND level <> '' AND salary_currency IN ('HUF', 'Ft/hó') AND stack <> '' AND stack IS NOT NULL")
            ->groupBy('level', 'stack')
            ->orderBy('stack', 'ASC')
            ->orderBy('level', 'ASC')
            ->get();

        $return = [];

        $lastStack = null;
        $stackItems = [];
        foreach ($collection as $item) {
            if (null === $lastStack) {
                $lastStack = $item->stack;
            } elseif ($item->stack !== $lastStack) {
                $return[] = [
                    'name' => $lastStack,
                    'series' => $stackItems,
                ];

                $stackItems = [];
                $lastStack = $item->stack;
            }

            $stackItems[] = [
                'name' => $item->level,
                'value' => (int) $item->value,
            ];
        }

        $return[] = [
            'name' => $lastStack,
            'series' => $stackItems,
        ];

        return $return;
    }
}
