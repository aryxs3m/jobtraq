<?php

namespace Database\Factories;

use App\Services\Scraper\ScraperManager;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CrawlerKeyword>
 */
class CrawlerKeywordFactory extends Factory
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
            'crawler' => $this->faker->randomElement($scraperManager->getServices()),
            'keywords' => ['test1', 'test2'],
        ];
    }
}
