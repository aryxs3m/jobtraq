<?php

namespace Admin\Controllers;

use App\Models\CrawlerKeyword;
use App\Models\User;
use Tests\TestCase;

class ScraperKeywordsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewScraperKeyword(): void
    {
        $user = $this->createAdministratorUser();
        $this->actingAs($user)->post('/scraper-keywords', [
            'crawler' => 'MockScraper',
            'keywords' => 'test1,test2',
        ]);

        $this->assertDatabaseHas(CrawlerKeyword::class, [
            'crawler' => 'MockScraper',
        ]);
    }

    public function testCanEditScraperKeyword(): void
    {
        $user = $this->createAdministratorUser();

        /** @var CrawlerKeyword $scraperKeyword */
        $scraperKeyword = CrawlerKeyword::factory()->create();

        $response = $this->actingAs($user)->get("/scraper-keywords/{$scraperKeyword->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('test1');

        $this->actingAs($user)->put("/scraper-keywords/{$scraperKeyword->id}", [
            'crawler' => $scraperKeyword->crawler,
            'keywords' => 'overwritten',
        ]);

        $this->assertDatabaseHas(CrawlerKeyword::class, [
            'keywords' => $this->castAsJson(['overwritten']),
        ]);
    }

    public function testCanShowScraperKeyword(): void
    {
        $user = $this->createAdministratorUser();

        /** @var CrawlerKeyword $scraperKeyword */
        $scraperKeyword = CrawlerKeyword::factory()->create();

        $response = $this->actingAs($user)->get('/scraper-keywords', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($scraperKeyword->id);
    }
}
