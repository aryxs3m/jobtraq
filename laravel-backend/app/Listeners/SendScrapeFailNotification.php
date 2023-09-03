<?php

namespace App\Listeners;

use App\Events\ScrapingFinished;
use App\Models\Country;
use App\Models\Location;
use App\Services\Report\PublicReporter;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        if ($event->totalListings === 0 || !$this->reporter->isDataReady()) {
            Log::channel('discord')->critical('No listings scraped or all data is invalid.');
        }
    }
}
