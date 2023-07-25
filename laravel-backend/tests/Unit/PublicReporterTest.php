<?php

namespace Tests\Unit;

use App\Services\Parser\HumanAdvertisementParser;
use App\Services\Report\PublicReporter;
use PHPUnit\Framework\TestCase;

class PublicReporterTest extends TestCase
{
    public function test_advertisement_parser_can_parse_levels(): void
    {
        /** @var PublicReporter $publicReporter */
        $publicReporter = app(PublicReporter::class);

    }
}
