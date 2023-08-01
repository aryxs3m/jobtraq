<?php

namespace App\Console\Commands;

use App\Models\JobListing;
use App\Models\Location;
use App\Services\Parser\ReParserService;
use App\Services\Scraper\ProfessionScraper;
use Illuminate\Console\Command;

class ImportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports hungarian cities as locations.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;

        $file = file_get_contents('storage/hungarian_cities.txt');
        $lines = explode("\n", $file);

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $cells = explode("\t", $line);

            try {
                Location::query()->create([
                    'location' => $cells[1],
                    'country_id' => 1,
                ]);
            } catch (\Throwable $throwable) {
                $this->error(sprintf('Failed to import %s, reason: %s',
                    $cells[1],
                    $throwable->getMessage(),
                ));
            }

            $count++;
        }

        $this->output->success(sprintf('Imported %s cities.', $count));
    }
}
