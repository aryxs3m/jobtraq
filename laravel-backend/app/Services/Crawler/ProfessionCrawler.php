<?php

namespace App\Services\Crawler;

use App\Services\Crawler\DTOs\Listing;
use App\Services\Crawler\DTOs\SalaryType;
use Goutte\Client;
use simplehtmldom\HtmlWeb;
use Sunra\PhpSimple\HtmlDomParser;

class ProfessionCrawler extends BaseJobListingCrawler
{
    public function crawlPage(string $type): array
    {
        $type = urlencode($type);
        $listings = [];

        $maxPages = 5;

        for ($page = 1; $page <= $maxPages; $page++) {
            $client = new HtmlWeb();
            $html = $client->load("https://www.profession.hu/allasok/{$page},0,0,{$type}%401%401,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,15?keywordsearch");

            if (null === $html) {
                continue;
            }

            try {
                foreach ($html->find('.job-cards li') as $postingListItem) {
                    $position = $postingListItem->find('.job-card__title', 0)->plaintext;
                    $salaryRaw = $postingListItem->find('.job-card__tag', 0)->plaintext;
                    $location = trim($postingListItem->find('.job-card__company-address', 0)->plaintext);

                    $listing = new Listing();
                    $listing->setPosition($position);
                    $listing->setLocation($location);
                    $this->setSalary($listing, $salaryRaw);
                    $listing->setCategory(
                        $this->advertisementParser->parseJobTitle($listing->getPosition()));
                    $listings[] = $listing;
                }
            } catch (\Throwable $throwable) {
                // TODO: log
            }

            sleep(1);
        }

        return $listings;
    }

    private function setSalary(Listing $listing, string $salaryRawText): void
    {
        $salaryParts = explode(' ', trim($salaryRawText));

        if (count($salaryParts) >= 5) {
            $salaryType = $salaryParts[0];
            $salaryLow = $salaryParts[1];
            $salaryHigh = $salaryParts[3];
            $salaryCurrency = $salaryParts[4];
        } else {
            $salaryType = $salaryParts[0];
            $salaryCurrency = $salaryParts[3];

            preg_match_all('/[0-9]+/', $salaryRawText, $matches);
            $salaryLow = implode('', $matches[0]);
            $salaryHigh = implode('', $matches[0]);
        }

        switch ($salaryType) {
            case 'Bruttó':
                $listing->setSalaryType(SalaryType::GROSS);
                break;
            case 'Nettó':
                $listing->setSalaryType(SalaryType::NET);
                break;
        }

        $listing->setSalaryLow($this->parseSalary($salaryLow));
        $listing->setSalaryHigh($this->parseSalary($salaryHigh));
        $listing->setSalaryCurrency($salaryCurrency);
    }
}
