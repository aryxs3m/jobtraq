<?php

namespace App\Services\Crawler;

use Illuminate\Console\OutputStyle;

class CrawlManager
{
    private OutputStyle $output;

    private const CRAWLERS = [
        NoFluffJobsCrawler::class,
        ProfessionCrawler::class,
    ];

    private const SEARCH_KEYWORDS = [
        'frontend',
        'backend',
        'devops',
        'analyst',
        'database',
    ];

    /**
     * @param OutputStyle $output
     */
    public function setOutput(OutputStyle $output): void
    {
        $this->output = $output;
    }

    public function crawlAll()
    {
        $listings = [];

        foreach (self::CRAWLERS as $crawlerClass) {
            $this->output->title($crawlerClass);

            /** @var JobListingCrawlerInterface $crawlerService */
            $crawlerService = app($crawlerClass);

            foreach (self::SEARCH_KEYWORDS as $keyword) {
                $this->output->writeln($keyword . " crawling ...");
                $listings = array_merge(
                    $listings,
                    $crawlerService->crawlPage($keyword)
                );
            }
        }

        $this->output->success('Total ' . count($listings) . ' listings crawled.');

        dd($listings);
    }
}
