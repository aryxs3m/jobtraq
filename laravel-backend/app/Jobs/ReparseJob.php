<?php

namespace App\Jobs;

use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReparseJob implements ShouldQueue
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
        /** @var ReParserService $reParserService */
        $reParserService = app(ReParserService::class);
        $count = 0;

        JobListing::query()
            ->chunk(100, function ($listings) use (&$count, &$reParserService) {
                $listings->each(function (JobListing $listing) use (&$count, &$reParserService) {
                    $reParserService->reparse($listing);
                    ++$count;
                });
            });

        Log::channel('discord')->info('Reparse finished.', [
            'count' => $count,
        ]);
    }
}
