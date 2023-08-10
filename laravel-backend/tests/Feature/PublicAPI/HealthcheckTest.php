<?php

namespace Tests\Feature\PublicAPI;

use App\Models\JobListing;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use Tests\TestCase;

class HealthcheckTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanGetHealthcheckEndpoint(): void
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function testFrontendAndBackendIsTrue(): void
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'frontend' => true,
                'backend' => true,
            ],
        ]);
    }

    public function testScrapersAreFailingTheHealthcheckWhenNoData(): void
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'scrapers' => [
                    [
                        'name' => class_basename(NoFluffJobsScraper::class),
                        'status' => false,
                    ],
                    [
                        'name' => class_basename(ProfessionScraper::class),
                        'status' => false,
                    ],
                ],
            ],
        ]);
    }

    public function testScrapersAreOkWhenThereIsData(): void
    {
        JobListing::factory()->noFluffJobs()->create();
        JobListing::factory()->profession()->create();

        $response = $this->get('/api/healthcheck');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'scrapers' => [
                    [
                        'name' => class_basename(NoFluffJobsScraper::class),
                        'status' => true,
                    ],
                    [
                        'name' => class_basename(ProfessionScraper::class),
                        'status' => true,
                    ],
                ],
            ],
        ]);
    }
}
