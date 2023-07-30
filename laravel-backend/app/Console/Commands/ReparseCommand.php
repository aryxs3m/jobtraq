<?php

namespace App\Console\Commands;

use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Illuminate\Console\Command;

class ReparseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:reparse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse job listings again by title';

    private ReParserService $reParserService;

    public function __construct(ReParserService $reParserService)
    {
        parent::__construct();
        $this->reParserService = $reParserService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;

        JobListing::query()
/*            ->whereNull('level')
            ->orWhereNull('position')
            ->orWhereNull('stack')*/
            ->chunk(100, function ($listings) use (&$count) {
                $listings->each(function (JobListing $listing) use (&$count) {
                    $this->output->writeln(sprintf('Reparsing %s...', $listing->id));
                    $this->reParserService->reparse($listing);
                    $count++;
                });
            });

        $this->output->success(sprintf('Reparsed %s listings.', $count));
    }
}
