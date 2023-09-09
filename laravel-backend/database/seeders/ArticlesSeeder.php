<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Country;
use App\Models\CrawlerKeyword;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\JobStack;
use App\Models\Location;
use App\Models\User;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArticlesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Article::factory()->create();
        }
    }
}
