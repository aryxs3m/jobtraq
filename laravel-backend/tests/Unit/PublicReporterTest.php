<?php

namespace Tests\Unit;

use App\Services\Report\PublicReporter;
use Tests\TestCase;

class PublicReporterTest extends TestCase
{
    public function test_advertisement_parser_can_parse_levels(): void
    {
        /** @var PublicReporter $publicReporter */
        $publicReporter = app(PublicReporter::class);

    }
}
