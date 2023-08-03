<?php

namespace Tests\Feature\PublicAPI;

use App\Models\JobListing;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use Tests\TestCase;

class ReportTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_cat_get_homepage_report(): void
    {
        $response = $this->get('/api/report/homepage');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }
}
