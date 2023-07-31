<?php

namespace App\Services\Report;

use App\Models\JobListing;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Publikus frontenden megjelenő chartokhoz, riportokhoz állítja elő az adatokat az adatbázisban tárolt álláshirdetések
 * alapján.
 */
class PublicReporter
{
    protected Carbon $filterDate;

    /**
     * Erre a napra szűrve lesznek generálva a riportok.
     */
    public function setFilterDate(Carbon $filterDate): void
    {
        $this->filterDate = $filterDate;
    }

    /**
     * Ellenőrzi, hogy a megadott filterDate-hez van-e már egyáltalán adat az adatbázisban.
     */
    public function isDataReady(): bool
    {
        return JobListing::query()
            ->whereDate('created_at', '=', $this->filterDate)
            ->count();
    }

    /**
     * Munkakör szerinti álláshirdetések számát adja vissza.
     *
     * @throws \Exception
     */
    public function getJobsCountByPosition(): Collection
    {
        return DB::table('job_listings')
            ->select('position AS name', DB::raw('COUNT(id) AS value'))
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->groupBy('position')
            ->orderBy('value', 'DESC')
            ->get();
    }

    /**
     * Álláshirdetések száma az elmúlt 4 hétben.
     */
    public function getJobsCountByWeek(): Collection
    {
        return DB::table('job_listings')
            ->select(DB::raw('WEEK(created_at, 7) AS name'), DB::raw('COUNT(id) AS value'))
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->groupBy(DB::raw('WEEK(created_at, 7)'))
            ->orderBy('name', 'DESC')
            ->limit(4)
            ->get()
            ->reverse()
            ->values();
    }

    /**
     * Álláshirdetések száma stackenként.
     */
    public function getJobsCountByStack(): Collection
    {
        return DB::table('job_listings')
            ->select('stack AS name', DB::raw('COUNT(id) AS value'))
            ->whereRaw("stack IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->groupBy('stack')
            ->orderBy('value', 'DESC')
            ->get();
    }

    /**
     * Átlagos fizetések szintenként egy megadott munkakörre.
     *
     * @param  string  $position munkakör
     */
    public function getAverageSalariesByLevels(string $position): Collection
    {
        return DB::table('job_listings')
            ->select('level AS name', 'job_levels.order', DB::raw('AVG(salary_low) AS value'))
            ->leftJoin('job_levels', 'job_levels.name', '=', 'job_listings.level')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(job_listings.created_at) = ?', [$this->getFilterDateSQL()])
            ->where('position', '=', $position)
            ->groupBy('level', 'job_levels.order')
            ->orderBy('job_levels.order')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'value' => (int) $item->value,
                ];
            });
    }

    /**
     * Átlagos fizetések szintenként és stackenként.
     */
    public function getAverageSalariesByStacksByLevels(): array
    {
        $collection = DB::table('job_listings')
            ->select('level', 'job_levels.order', 'stack', DB::raw('AVG(salary_low) AS value'))
            ->leftJoin('job_levels', 'job_levels.name', '=', 'job_listings.level')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó') AND stack IS NOT NULL")
            ->whereRaw('DATE(job_listings.created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->groupBy('level', 'job_levels.order', 'stack')
            ->orderBy('stack', 'ASC')
            ->orderBy('job_levels.order', 'ASC')
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

    /**
     * @throws \Exception ha nincs beállítva dátum a szűréshez
     */
    protected function getFilterDateSQL(): string
    {
        if (null === $this->filterDate) {
            throw new \Exception('Filter date is not set.');
        }

        return $this->filterDate->format('Y-m-d');
    }
}
