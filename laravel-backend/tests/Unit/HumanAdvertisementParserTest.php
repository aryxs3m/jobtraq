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

    public function testAdvertisementParserCanParseLevels(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue('junior' === $jobCategory->getLevel());

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue('senior' === $jobCategory->getLevel());

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue('lead' === $jobCategory->getLevel());
    }

    public function testAdvertisementParserCanParseStack(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue('php' === $jobCategory->getStack());

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue('java' === $jobCategory->getStack());

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue('python' === $jobCategory->getStack());
    }

    public function testAdvertisementParserCanParsePosition(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior Full-Stack PHP Developer');
        $this->assertTrue('full-stack' === $jobCategory->getPosition());

        $jobCategory = $advertisementParser->parseJobTitle('Senior Java Backend Developer');
        $this->assertTrue('backend' === $jobCategory->getPosition());

        $jobCategory = $advertisementParser->parseJobTitle('Lead Data Engineer (Python)');
        $this->assertTrue('data' === $jobCategory->getPosition());
    }

    public function testAdvertisementParserCanGetFallbackPosition(): void
    {
        /** @var HumanAdvertisementParser $advertisementParser */
        $advertisementParser = app(HumanAdvertisementParser::class);

        $jobCategory = $advertisementParser->parseJobTitle('Junior PHP Developer');
        $this->assertTrue('backend' === $jobCategory->getPosition());
    }
}
