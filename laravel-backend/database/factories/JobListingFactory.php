<?php

namespace Database\Factories;

use App\Models\Location;
use App\Services\Scraper\DTOs\SalaryType;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use App\Services\Scraper\ScraperManager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var ScraperManager $scraperManager */
        $scraperManager = app(ScraperManager::class);

        return [
            'name' => $this->faker->randomElement(['PHP developer', 'Senior Angular frontend developer', 'Delphi fejlesztő']),
            'salary_type' => SalaryType::GROSS,
            'salary_low' => 100000,
            'salary_high' => 3000000,
            'salary_currency' => 'HUF',
            'original_location' => 'Budapest',
            'level' => $this->faker->randomElement(['senior', 'medior', 'junior', 'lead']),
            'position' => $this->faker->randomElement(['frontend', 'backend', 'data']),
            'stack' => $this->faker->randomElement(['PHP', 'Java', 'C++', 'Pascal']),
            'crawler' => $this->faker->randomElement($scraperManager->getServices()),
            'location_id' => Location::LOCATION_HUNGARY,
            'external_id' => $this->faker->word,
        ];
    }

    public function noFluffJobs(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'crawler' => NoFluffJobsScraper::class,
            ];
        });
    }

    public function profession(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'crawler' => ProfessionScraper::class,
            ];
        });
    }
}
