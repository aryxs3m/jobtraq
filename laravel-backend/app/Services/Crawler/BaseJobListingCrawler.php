<?php

namespace App\Services\Crawler;

use App\Services\Parser\HumanAdvertisementParser;

abstract class BaseJobListingCrawler implements JobListingCrawlerInterface
{
    protected HumanAdvertisementParser $advertisementParser;

    public function __construct(HumanAdvertisementParser $advertisementParser)
    {
        $this->advertisementParser = $advertisementParser;
    }

    protected const MULTIPLIERS = [
        'M' => 1000000,
        'm' => 1000000,
        'k' => 1000,
        'e' => 1000,
    ];

    protected function parseSalary(string $salaryString): float
    {
        $multiplier = 1;

        $salaryString = trim($salaryString);
        $salaryString = str_replace(',', '.', $salaryString);
        $salaryString = str_replace('Ft', '', $salaryString);

        $multiplierPrefix = mb_substr($salaryString, -1, 1);

        if (in_array($multiplierPrefix, array_keys(self::MULTIPLIERS))) {
            $multiplier = self::MULTIPLIERS[$multiplierPrefix];
            $salaryNumber = (float) mb_substr($salaryString, 0, -1);
        } else {
            $salaryNumber = (float) $salaryString;
        }

        return $salaryNumber * $multiplier;
    }
}
