<?php

namespace App\Services\Crawler;

use App\Services\Crawler\DTOs\Listing;
use App\Services\Crawler\DTOs\SalaryType;
use simplehtmldom\HtmlWeb;

class NoFluffJobsCrawler extends BaseJobListingCrawler
{
    public function crawlPage(string $type): array
    {
        $type = urlencode($type);
        $listings = [];

        $maxPages = 5;

        for ($page = 1; $page <= $maxPages; $page++) {
            $html = $this->downloadPage("https://nofluffjobs.com/hu/{$type}?page={$page}");

            try {
                foreach ($html->find('.posting-list-item') as $postingListItem) {
                    try {
                        $listing = new Listing();
                        $listing->setPosition($postingListItem->find('.posting-title__position', 0)->plaintext);

                        $salaryRaw = $postingListItem->find('.salary', 0)->plaintext;
                        $this->setSalary($listing, $salaryRaw);

                        $location = trim($postingListItem->find('.posting-info__location', 0)->plaintext);
                        $listing->setLocation($location);

                        $listing->setCategory(
                            $this->advertisementParser->parseJobTitle($listing->getPosition()));

                        $listings[] = $listing;
                    } catch (\Throwable $throwable) {
                        // TODO: log
                    }
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
            $salaryLow = $salaryParts[0];
            $salaryHigh = $salaryParts[3];
            $salaryCurrency = $salaryParts[5];
        } else {
            $salaryLow = $salaryParts[0];
            $salaryHigh = $salaryParts[0];
            $salaryCurrency = $salaryParts[2];
        }

        $listing->setSalaryType(SalaryType::GROSS);
        $listing->setSalaryLow($this->parseSalary($salaryLow));
        $listing->setSalaryHigh($this->parseSalary($salaryHigh));
        $listing->setSalaryCurrency($salaryCurrency);
    }
}
