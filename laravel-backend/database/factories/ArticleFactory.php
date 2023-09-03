<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Test article',
            'published_at' => Carbon::now(),
            'published' => true,
            'image_url' => 'https://example.com/image.jpg',
            'slug' => 'test-article',
            'introduction' => 'This is the introduction.',
            'content' => '**This** is the markdown __content__.',
            'user_id' => User::factory()->create()->id,
        ];
    }
}
