<?php

namespace PublicAPI;

use App\Models\JobListing;
use App\Models\Subscription;
use App\Services\Scraper\NoFluffJobsScraper;
use App\Services\Scraper\ProfessionScraper;
use Tests\TestCase;

class SubscribtionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanSubscribeWebhook(): void
    {
        $webhookUrl = 'https://app.example.com/webhook/webhook-id';

        $response = $this->post('/api/subscribe/discord', [
            'webhook_url' => $webhookUrl,
        ]);

        $response->assertStatus(200);
        $response->assertSimilarJson([
            'status' => 'success',
            'data' => [
                'id' => 1,
            ]
        ]);

        $this->assertDatabaseHas(Subscription::class, [
            'type' => 'discord',
        ]);
    }
}
