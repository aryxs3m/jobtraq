<?php

namespace App\Services;

use App\Models\JobListing;

class HealthCheckService
{
    /**
     * Ellenőrzi, hogy a scraper olvasott-e már be a mai napon álláshirdetést. Ha igen, akkor élőnek tekintjük.
     *
     * @param string $scraperClass
     */
    public function checkScraperHealthForToday(string $scraperClass): bool
    {
        /** @var JobListing $jobListing */
        $jobListing = JobListing::query()
            ->where('crawler', '=', $scraperClass)
            ->orderBy('id', 'DESC')
            ->first();

        if (null === $jobListing) {
            return false;
        }

        return $jobListing->created_at->isToday();
    }
}
