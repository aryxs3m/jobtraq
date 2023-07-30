<?php

namespace App\Services;

use App\Models\JobListing;

class HealthCheckService
{
    /**
     * Ellenőrzi, hogy a scraper olvasott-e már be a mai napon álláshirdetést. Ha igen, akkor élőnek tekintjük.
     *
     * @param string $scraperClass
     * @return bool
     */
    public function checkScraperHealthForToday($scraperClass): bool
    {
        /** @var JobListing $jobListing */
        $jobListing = JobListing::query()
            ->where('crawler', '=', $scraperClass)
            ->orderBy('id', 'DESC')
            ->first();

        return $jobListing->created_at->isToday();
    }
}
