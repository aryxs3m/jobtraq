<?php

namespace App\Services\Scraper;

use App\Models\ScraperLog;
use App\Services\Parser\HumanAdvertisementParser;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use Illuminate\Support\Facades\Log;
use simplehtmldom\simple_html_dom;

abstract class BaseJobListingScraper implements JobListingScraperInterface
{
    protected HumanAdvertisementParser $advertisementParser;

    public function __construct(HumanAdvertisementParser $advertisementParser)
    {
        // Limit for HTML DOM parsing
        if (!defined('MAX_FILE_SIZE')) {
            define('MAX_FILE_SIZE', 6000000);
        }

        $this->advertisementParser = $advertisementParser;
    }

    protected const MULTIPLIERS = [
        'M' => 1000000,
        'm' => 1000000,
        'k' => 1000,
        'e' => 1000,
    ];

    protected function downloadPage(string $url): simple_html_dom
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'JobTraq 1.0 (https://jobtraq.hu, info@jobtraq.hu)');
        $content = curl_exec($curl);
        curl_close($curl);

        return HtmlDomParser::str_get_html($content);
    }

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

    protected function logError(\Throwable $throwable): void
    {
        ScraperLog::query()->create([
            'scraper' => static::class,
            'log' => [
                'name' => class_basename($throwable),
                'message' => $throwable->getMessage(),
                'trace' => $throwable->getTrace(),
            ],
        ]);

        Log::error('Scraper error.', (array) $throwable);
    }
}
