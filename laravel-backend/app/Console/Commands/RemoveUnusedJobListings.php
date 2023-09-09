<?php

namespace App\Console\Commands;

use App\Models\JobListing;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveUnusedJobListings extends Command
{
    private const MONTHS = 12;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:remove-unused-job-listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes old, unused job listings from the databases.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobListings = JobListing::query()
            ->whereNull('level')
            ->whereNull('stack')
            ->whereNull('position')
            ->whereDate('created_at', '<', Carbon::now()->subMonths(self::MONTHS));

        $this->line(sprintf(
            '%s listings will be deleted. These are older than %s months and still not categorized.',
            $jobListings->count(),
            self::MONTHS
        ));

        $jobListings->delete();

        Log::channel('discord')->info('Unused job listings removed.', ['count' => $jobListings->count()]);
    }
}
