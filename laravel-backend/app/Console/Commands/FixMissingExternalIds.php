<?php

namespace App\Console\Commands;

use App\Models\JobListing;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class FixMissingExternalIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:fix-external-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills external_ids for old job listings.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countUnableToFindFull = 0;
        $countFixed = 0;

        JobListing::query()
            ->where('external_id', '=', '')
            ->chunk(100, function (Collection $jobListings) use (&$countUnableToFindFull, &$countFixed) {
                $jobListings->each(function (JobListing $jobListing) use (&$countUnableToFindFull, &$countFixed) {
                    $fullJobListing = JobListing::query()
                        ->where('name', '=', $jobListing->name)
                        ->where('external_id', '<>', '')
                        ->where('crawler', $jobListing->crawler)
                        ->first();

                    if (!$fullJobListing) {
                        $countUnableToFindFull++;
                        return;
                    }

                    $jobListing->external_id = $fullJobListing->external_id;
                    $jobListing->save();
                    $countFixed++;
                });
            });

        $this->output->success(sprintf('Fixed job listings: %s', $countFixed));
        $this->output->warning(sprintf('Failed to fix: %s', $countUnableToFindFull));
    }
}
