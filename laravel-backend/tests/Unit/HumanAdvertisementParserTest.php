<?php

namespace Tests\Unit;

use App\Services\Parser\HumanAdvertisementParser;
use Tests\TestCase;

class HumanAdvertisementParserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_advertisement_parser_can_parse_levels(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue($jobCategory->getLevel() === 'junior');

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue($jobCategory->getLevel() === 'senior');

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue($jobCategory->getLevel() === 'lead');
    }

    public function test_advertisement_parser_can_parse_stack(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue($jobCategory->getStack() === 'php');

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue($jobCategory->getStack() === 'java');

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue($jobCategory->getStack() === 'python');
    }

    public function test_advertisement_parser_can_parse_position(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior Full-Stack PHP Developer');
        $this->assertTrue($jobCategory->getPosition() === 'full-stack');

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue($jobCategory->getPosition() === 'backend');

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue($jobCategory->getPosition() === 'data');
    }

    public function test_advertisement_parser_can_get_fallback_position(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue($jobCategory->getPosition() === 'backend');
    }
}
