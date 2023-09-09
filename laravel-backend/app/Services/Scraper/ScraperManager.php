<?php

namespace App\Services\Scraper;

use App\Events\ScrapingFinished;
use App\Models\CrawlerKeyword;
use App\Models\JobListing;
use App\Services\Scraper\DTOs\Listing;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Log;

class ScraperManager
{
    private ?OutputStyle $output = null;

    private const SCRAPERS = [
        NoFluffJobsScraper::class,
        ProfessionScraper::class,
    ];

    public function setOutput(OutputStyle $output): void
    {
        $this->output = $output;
    }

    public function scrapeAll(): void
    {
        $listingsCount = 0;

        /** @var CrawlerKeyword $crawlerKeyword */
        foreach (CrawlerKeyword::all() as $crawlerKeyword) {
            $this->output?->writeln($crawlerKeyword->crawler);

            /** @var JobListingScraperInterface $crawlerService */
            $crawlerService = app($crawlerKeyword->crawler);

            foreach ($crawlerKeyword->keywords as $keyword) {
                $this->output?->writeln(sprintf(' > %s scraping ...', $keyword));
                $listings = $crawlerService->scrapePage($keyword);
                $this->saveListings($crawlerKeyword->crawler, $listings);

                $listingsCount += count($listings);

                Log::channel('scraper')->info(sprintf(
                    '%s:%s scraped %s listings',
                    $crawlerKeyword->crawler,
                    $keyword,
                    count($listings)
                ));
            }
        }

        $this->output?->success(sprintf('Total %s listings scraped.', $listingsCount));

        Log::channel('scraper')->info(sprintf(
            'Scraping finished. Total %s listings found.',
            $listingsCount
        ));

        Log::channel('discord')->info('Scraping finished.', [
            'New listings' => $listingsCount,
        ]);

        ScrapingFinished::dispatch($listingsCount);
    }

    /**
     * @param Listing[] $listings
     */
    private function saveListings(string $crawler, array $listings): void
    {
        foreach ($listings as $listing) {
            JobListing::query()->create([
                'external_id' => $listing->getExternalId(),
                'name' => $listing->getPosition(),
                'salary_low' => $listing->getSalaryLow(),
                'salary_high' => $listing->getSalaryHigh(),
                'salary_currency' => $listing->getSalaryCurrency(),
                'salary_type' => $listing->getSalaryType(),
                'original_location' => $listing->getLocation(),
                'location_id' => $listing->getLocationId(),
                'position' => $listing->getCategory()->getPosition(),
                'level' => $listing->getCategory()->getLevel(),
                'stack' => $listing->getCategory()->getStack(),
                'crawler' => $crawler,
            ]);
        }
    }

    public function getServices(): array
    {
        return self::SCRAPERS;
    }
}
