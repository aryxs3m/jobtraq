<?php

namespace App\Console\Commands;

use App\Services\Scraper\ScraperManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all scrapers';

    private ScraperManager $scraper;

    public function __construct(ScraperManager $crawler)
    {
        $this->scraper = $crawler;

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::channel('scraper')->info('Scraping started');
        $this->scraper->setOutput($this->output);

        $this->scraper->scrapeAll();
    }
}
