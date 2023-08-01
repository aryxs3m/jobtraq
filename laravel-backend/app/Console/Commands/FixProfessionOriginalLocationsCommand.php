<?php

namespace App\Console\Commands;

use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use App\Services\Scraper\ProfessionScraper;
use Illuminate\Console\Command;

class FixProfessionOriginalLocationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:fix:profession-location-decode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes missing html_entity_decode on original_location fields.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;

        JobListing::query()
            ->where('crawler', '=', ProfessionScraper::class)
            ->chunk(100, function ($listings) use (&$count) {
                $listings->each(function (JobListing $listing) use (&$count) {
                    $listing->original_location = html_entity_decode($listing->original_location);
                    $listing->save();
                    $count++;
                });
            });

        $this->output->success(sprintf('Fixed %s listings.', $count));
    }
}
