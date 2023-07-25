<?php

namespace App\Services\Crawler;

use App\Models\CrawlerKeyword;
use App\Models\JobListing;
use App\Services\Crawler\DTOs\Listing;
use Illuminate\Console\OutputStyle;

class CrawlManager
{
    private OutputStyle $output;

    private const CRAWLERS = [
        NoFluffJobsCrawler::class,
        ProfessionCrawler::class,
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
        $listings = [];

        foreach (CrawlerKeyword::all() as $crawlerKeyword) {
            $this->output->title($crawlerKeyword->crawler);

            /** @var JobListingCrawlerInterface $crawlerService */
            $crawlerService = app($crawlerKeyword->crawler);

            foreach ($crawlerKeyword->keywords as $keyword) {
                $this->output->writeln($keyword . " crawling ...");
                $listings = $crawlerService->crawlPage($keyword);
                $this->saveListings($crawlerKeyword->crawler, $listings);
            }
        }

        $this->output->success('Total ' . count($listings) . ' listings crawled.');
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
                'position' => $listing->getCategory()->getPosition() ?? '',
                'level' => $listing->getCategory()->getLevel() ?? '',
                'stack' => $listing->getCategory()->getStack() ?? '',
                'crawler' => $crawler,
            ]);
        }
    }

    public function getServices()
    {
        return self::CRAWLERS;
    }
}
