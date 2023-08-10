<?php

namespace Tests\Feature\PublicAPI;

use Tests\TestCase;

class ReportTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCatGetHomepageReport(): void
    {
        if ('sqlite' === config('database.default')) {
            $this->markTestSkipped('SQLite not supported.');
        }

        $response = $this->get('/api/report/homepage');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }
}
