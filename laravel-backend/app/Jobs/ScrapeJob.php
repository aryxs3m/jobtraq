<?php

namespace App\Jobs;

use App\Services\Scraper\ScraperManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var ScraperManager $scraperManager */
        $scraperManager = app(ScraperManager::class);
        $scraperManager->scrapeAll();
    }
}
