<?php

namespace App\Console\Commands;

use App\Services\Scraper\ScraperManager;
use Illuminate\Console\Command;

class CrawlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawls job portals';

    private ScraperManager $crawler;

    public function __construct(ScraperManager $crawler)
    {
        $this->crawler = $crawler;

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->crawler->setOutput($this->output);
        $this->crawler->crawlAll();
    }
}
