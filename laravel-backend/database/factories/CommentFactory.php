<?php

namespace Database\Factories;

use App\DataTables\ArticlesDataTable;
use App\Models\Article;
use App\Models\Enums\CommentStatus;
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
            'name' => $this->faker->name,
            'message' => $this->faker->sentence,
            'status' => CommentStatus::AWAITING_MODERATION,
            'ip_address' => $this->faker->ipv4,
            'article_id' => Article::factory()->create()->id,
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
