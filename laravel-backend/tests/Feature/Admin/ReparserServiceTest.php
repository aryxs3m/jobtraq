<?php

namespace Admin;

use App\Models\JobListing;
use App\Services\Parser\ReParserService;
use Tests\TestCase;

class ReparserServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanReparseNotParsedListing(): void
    {
        $jobListing = JobListing::factory()->make();
        $jobListing->stack = '';
        $jobListing->level = '';
        $jobListing->position = '';
        $jobListing->name = 'Senior PHP backend fejlesztő';
        $jobListing->save();

        $this->assertEmpty($jobListing->stack);
        $this->assertEmpty($jobListing->level);
        $this->assertEmpty($jobListing->position);

        /** @var ReParserService $reparserService */
        $reparserService = $this->app->get(ReParserService::class);
        $reparserService->reparse($jobListing);

        $this->assertNotEmpty($jobListing->stack);
        $this->assertNotEmpty($jobListing->level);
        $this->assertNotEmpty($jobListing->position);
    }
}
