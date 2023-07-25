<?php

namespace App\Console\Commands;

use App\Services\Report\PublicReporter;
use Illuminate\Console\Command;

class ReporterTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:reporter-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var PublicReporter $pr */
        $pr = app(PublicReporter::class);

        dd($pr->getAverageSalariesByPositions());
    }
}
