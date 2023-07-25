<?php

namespace App\Services\Crawler;

use App\Services\Crawler\DTOs\Listing;

interface JobListingCrawlerInterface
{
    /**
     * @param string $type search keywords
     *
     * @return Listing[]
     */
    public function crawlPage(string $type): array;
}
