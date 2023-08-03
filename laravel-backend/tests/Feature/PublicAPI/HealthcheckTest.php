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

    public function test_can_get_healthcheck_endpoint(): void
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function test_frontend_and_backend_is_true(): void
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

    public function test_scrapers_are_failing_the_healthcheck_when_no_data(): void
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

    public function test_scrapers_are_ok_when_there_is_data(): void
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
