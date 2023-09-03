<?php

namespace Database\Factories;

use App\Models\Country;
use App\Services\Scraper\ScraperManager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CrawlerKeyword>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => 'Factory Teszt Hely',
            'country_id' => Country::factory()->create()->id,
        ];
    }
}
