<?php

namespace App\Listeners;

use App\Events\ScrapingFinished;
use App\Models\Location;
use App\Services\Report\PublicReporter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendScrapeFailNotification
{
    private PublicReporter $reporter;

    /**
     * Create the event listener.
     */
    public function __construct(PublicReporter $reporter)
    {
        $reporter->setFilterDate(Carbon::now());
        $reporter->setCountryId(Location::LOCATION_HUNGARY);

        $this->reporter = $reporter;
    }

    /**
     * Handle the event.
     */
    public function handle(ScrapingFinished $event): void
    {
        if (0 === $event->totalListings || !$this->reporter->isDataReady()) {
            Log::channel('discord')->critical('No listings scraped or all data is invalid.');
        }
    }
}
