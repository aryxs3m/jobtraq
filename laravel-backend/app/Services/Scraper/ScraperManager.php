<?php

namespace App\Services\Scraper;

use App\Models\CrawlerKeyword;
use App\Models\JobListing;
use App\Services\Scraper\DTOs\Listing;
use Illuminate\Console\OutputStyle;

class ScraperManager
{
    private OutputStyle $output;

    private const CRAWLERS = [
        NoFluffJobsScraper::class,
        ProfessionScraper::class,
    ];

    /**
     * @param OutputStyle $output
     */
    public function setOutput(OutputStyle $output): void
    {
        $this->output = $output;
    }

    public function crawlAll(): void
    {
        $listingsCount = 0;

        foreach (CrawlerKeyword::all() as $crawlerKeyword) {
            $this->output->title($crawlerKeyword->crawler);

            /** @var JobListingScraperInterface $crawlerService */
            $crawlerService = app($crawlerKeyword->crawler);

            foreach ($crawlerKeyword->keywords as $keyword) {
                $this->output->writeln($keyword . " crawling ...");
                $listings = $crawlerService->scrapePage($keyword);
                $this->saveListings($crawlerKeyword->crawler, $listings);

                $listingsCount += count($listings);
            }
        }

        $this->output->success(sprintf('Total %s listings crawled.', $listingsCount));
    }

    /**
     * @param Listing[] $listings
     * @return void
     */
    private function saveListings(string $crawler, array $listings): void
    {
        $this->output->comment('Saving listings...');

        foreach ($listings as $listing) {
            JobListing::create([
                'name' => $listing->getPosition(),
                'salary_low' => $listing->getSalaryLow(),
                'salary_high' => $listing->getSalaryHigh(),
                'salary_currency' => $listing->getSalaryCurrency(),
                'salary_type' => $listing->getSalaryType(),
                'location' => $listing->getLocation(),
                'position' => $listing->getCategory()->getPosition(),
                'level' => $listing->getCategory()->getLevel(),
                'stack' => $listing->getCategory()->getStack(),
                'crawler' => $crawler,
            ]);
        }
    }

    public function getServices()
    {
        return self::CRAWLERS;
    }
}
