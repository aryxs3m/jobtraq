<?php

namespace App\Services\Scraper;

use App\Services\Scraper\DTOs\Listing;
use App\Services\Scraper\DTOs\SalaryType;

class ProfessionScraper extends BaseJobListingScraper
{
    public function scrapePage(string $type): array
    {
        $type = urlencode($type);
        $listings = [];

        $maxPages = 5;

        for ($page = 1; $page <= $maxPages; $page++) {
            $html = $this->downloadPage("https://www.profession.hu/allasok/{$page},0,0,{$type}%401%401,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,15?keywordsearch");

            try {
                foreach ($html->find('.job-cards li') as $postingListItem) {
                    try {
                        $position = $postingListItem->find('.job-card__title', 0)->plaintext;
                        $salaryRaw = $postingListItem->find('.job-card__tag', 0)->plaintext;
                        $location = html_entity_decode(trim(
                            $postingListItem->find('.job-card__company-address', 0)->plaintext
                        ));

                        $listing = new Listing();
                        $listing->setPosition($position);
                        $listing->setLocation($location);
                        $listing->setLocationId($this->advertisementParser->parseJobLocation($location));
                        $this->setSalary($listing, $salaryRaw);
                        $listing->setCategory(
                            $this->advertisementParser->parseJobTitle($listing->getPosition()));

                        $listings[] = $listing;
                    } catch (\Throwable $throwable) {
                        $this->logError($throwable);
                    }
                }
            } catch (\Throwable $throwable) {
                $this->logError($throwable);
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
