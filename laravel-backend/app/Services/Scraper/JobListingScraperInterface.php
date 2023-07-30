<?php

namespace App\Services\Scraper;

use App\Services\Scraper\DTOs\Listing;

interface JobListingScraperInterface
{
    /**
     * @param  string  $type search keywords
     * @return Listing[]
     */
    public function scrapePage(string $type): array;
}
