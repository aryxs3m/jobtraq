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
            'title' => $this->faker->sentence(3, 2),
            'published_at' => Carbon::now(),
            'published' => true,
            'image_url' => 'https://picsum.photos/1280/720',
            'slug' => implode('-', $this->faker->words(4)),
            'introduction' => $this->faker->sentence,
            'content' => '**This** is the markdown __content__.',
            'user_id' => User::factory()->create()->id,
        ];
    }
}
