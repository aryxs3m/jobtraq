<?php

namespace App\Services\Report;

use App\Models\JobLevel;
use App\Models\JobListing;
use App\Models\JobPosition;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LangReporter extends PublicReporter
{
    protected const LIMIT_WEEKS = 32;

    /**
     * @throws \Exception
     */
    public function getLangReport(string $lang): array
    {
        return [
            'isDataReady' => $this->isLangDataReady($lang),
            'popularity' => $this->getPopularity($lang),
            'salaries' => $this->getSalaries($lang),
            'barOpenPositions' => $this->getJobsCountByWeek($lang, self::LIMIT_WEEKS),
            'weeklySalaries' => $this->getAverageSalariesByLevelsWeekly($lang, self::LIMIT_WEEKS),
        ];
    }

    /**
     * Ellenőrzi, hogy a megadott filterDate-hez van-e adatunk.
     */
    public function isLangDataReady(string $lang): bool
    {
        return JobListing::query()
            ->where('stack', '=', $lang)
            ->count();
    }

    public function getAverageSalariesByLevelsWeekly(string $lang, int $limit): array
    {
        $dateFilter = Carbon::now()->subWeeks($limit);

        $collection = DB::table('job_listings')
            ->select(
                'level',
                    'job_levels.order',
                    DB::raw('YEAR(job_listings.created_at) AS year_label'),
                    DB::raw('WEEK(job_listings.created_at, 7) AS week_label'),
                    DB::raw('AVG(salary_low) AS value')
            )
            ->leftJoin('job_levels', 'job_levels.name', '=', 'job_listings.level')
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó') AND stack IS NOT NULL")
            ->whereRaw('DATE(job_listings.created_at) > :filterDate', ['filterDate' => $dateFilter])
            ->whereRaw('locations.country_id = :countryId', ['countryId' => $this->getCountryId()])
            ->whereRaw('stack = :stack', ['stack' => $lang])
            ->groupBy('level', 'job_levels.order', 'year_label', 'week_label')
            ->orderBy('year_label', 'ASC')
            ->orderBy('week_label', 'ASC')
            ->orderBy('job_levels.order', 'ASC')
            ->get();

        $return = [];

        $lastStack = null;
        $stackItems = [];
        foreach ($collection as $item) {
            if (null === $lastStack) {
                $lastStack = $item->week_label;
            } elseif ($item->week_label !== $lastStack) {
                $return[] = [
                    'name' => $lastStack,
                    'series' => $stackItems,
                ];

                $stackItems = [];
                $lastStack = $item->week_label;
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

    protected function getPopularity(string $lang): array
    {
        return [
            'listings_today' => $this->countListings(
                $lang,
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ),
            'listings_6_months' => $this->countListings(
                $lang,
                Carbon::now()->subMonths(6)->startOfDay(),
                Carbon::now()->endOfDay()
            ),
            'listings_12_months' => $this->countListings(
                $lang,
                Carbon::now()->subMonths(12)->startOfDay(),
                Carbon::now()->endOfDay()
            ),
        ];
    }

    protected function getSalaries(string $lang): array
    {
        $start = Carbon::now()->subMonths(6)->startOfDay();
        $end = Carbon::now()->endOfDay();
        $levels = JobLevel::all()->pluck('name');

        $median = [];

        foreach ($levels as $level) {
            $median[] = [
                'level' => $level,
                'values' => $this->calculateSalaries($lang, $level, $start, $end),
            ];
        }

        return $median;
    }

    protected function countListings(string $lang, Carbon $start, Carbon $end): int
    {
        return DB::query()
            ->distinct()
            ->select(DB::raw('COUNT(DISTINCT job_listings.external_id) as cnt'))
            ->from('job_listings')
            ->where('stack', '=', $lang)
            ->where('location_id', '=', $this->getCountryId())
            ->whereBetween('created_at', [
                $start,
                $end,
            ])
            ->whereNotNull(['level', 'position'])
            ->get()[0]->cnt;
    }

    protected function calculateSalaries(string $lang, string $level, Carbon $start, Carbon $end): array
    {
        $salaries = DB::query()
            ->distinct()
            ->select('salary_avg')
            ->from('job_listings')
            ->where('stack', '=', $lang)
            ->where('location_id', '=', $this->getCountryId())
            ->whereBetween('created_at', [
                $start,
                $end,
            ])
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->where('level', '=', $level)
            ->get();

        return [
            'median' => $salaries->median('salary_avg'),
            'average' => $salaries->average('salary_avg'),
        ];
    }
}
