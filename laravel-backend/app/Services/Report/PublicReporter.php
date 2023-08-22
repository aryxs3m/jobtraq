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

    protected int $countryId;

    public static function make(): static
    {
        return new static();
    }

    /**
     * Erre a napra szűrve lesznek generálva a riportok.
     */
    public function setFilterDate(Carbon $filterDate): static
    {
        $this->filterDate = $filterDate;

        return $this;
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
            ->select('position AS name', DB::raw('COUNT(1) AS value'))
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->leftJoin('job_positions', 'job_positions.name', '=', 'job_listings.position')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(job_listings.created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->whereRaw('locations.country_id = :countryId', ['countryId' => $this->getCountryId()])
            ->whereRaw('job_positions.hidden_in_statistics = 0')
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
            ->select(
                DB::raw('WEEK(job_listings.created_at, 7) AS name'),
                DB::raw('COUNT(DISTINCT job_listings.external_id) AS value'))
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('locations.country_id = :countryId', ['countryId' => $this->getCountryId()])
            ->groupBy(DB::raw('WEEK(job_listings.created_at, 7)'))
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
            ->select('stack AS name', DB::raw('COUNT(1) AS value'))
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->whereRaw("stack IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(job_listings.created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->whereRaw('locations.country_id = :countryId', ['countryId' => $this->getCountryId()])
            ->groupBy('stack')
            ->orderBy('value', 'DESC')
            ->get();
    }

    /**
     * Átlagos fizetések szintenként egy megadott munkakörre.
     *
     * @param string $position munkakör
     */
    public function getAverageSalariesByLevels(string $position): Collection
    {
        return DB::table('job_listings')
            ->select('level AS name', 'job_levels.order', DB::raw('AVG(salary_low) AS value'))
            ->leftJoin('job_levels', 'job_levels.name', '=', 'job_listings.level')
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó')")
            ->whereRaw('DATE(job_listings.created_at) = ?', [$this->getFilterDateSQL()])
            ->whereRaw('locations.country_id = ?', [$this->getCountryId()])
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
            ->leftJoin('locations', 'locations.id', '=', 'job_listings.location_id')
            ->whereRaw("position IS NOT NULL AND level IS NOT NULL AND salary_currency IN ('HUF', 'Ft/hó') AND stack IS NOT NULL")
            ->whereRaw('DATE(job_listings.created_at) = :filterDate', ['filterDate' => $this->getFilterDateSQL()])
            ->whereRaw('locations.country_id = :countryId', ['countryId' => $this->getCountryId()])
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

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): static
    {
        $this->countryId = $countryId;

        return $this;
    }
}
