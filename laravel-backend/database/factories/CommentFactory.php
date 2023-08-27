<?php

namespace Database\Factories;

use App\Models\Enums\CommentStatus;
use App\Models\Location;
use App\Models\User;
use App\Services\Scraper\DTOs\SalaryType;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use App\Services\Scraper\ScraperManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Commenter',
            'message' => 'This is a test comment',
            'status' => CommentStatus::AWAITING_MODERATION,
            'ip_address' => $this->faker->ipv4,
        ];
    }

    public function approved(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => CommentStatus::APPROVED,
            ];
        });
    }

    public function denied(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => CommentStatus::DENIED,
            ];
        });
    }
}
