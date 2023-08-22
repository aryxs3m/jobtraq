<?php

namespace App\Services\Scraper;

use App\Services\Scraper\DTOs\Listing;
use App\Services\Scraper\DTOs\SalaryType;
use simplehtmldom\simple_html_dom_node;

class ProfessionScraper extends BaseJobListingScraper
{
    public function scrapePage(string $type): array
    {
        $type = urlencode($type);
        $listings = [];

        $maxPages = 20;

        $progressBar = $this->output->createProgressBar($maxPages);
        $progressBar->start();

        for ($page = 1; $page <= $maxPages; ++$page) {
            $html = $this->downloadPage("https://www.profession.hu/allasok/{$page},0,0,{$type}%401%401,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,15?keywordsearch");

            try {
                $items = $html->find('.job-cards li');

                if (0 === \count($items)) {
                    $this->output->writeln(sprintf(' - Page %s is empty.', $page));
                    break;
                }

                /** @var simple_html_dom_node $postingListItem */
                foreach ($items as $postingListItem) {
                    try {
                        $position = $postingListItem->find('.job-card__title', 0)->plaintext;
                        $salaryRaw = $postingListItem->find('.job-card__tag', 0)->plaintext;
                        $location = html_entity_decode(trim(
                            $postingListItem->find('.job-card__company-address', 0)->plaintext
                        ));

                        $listing = new Listing();
                        $listing->setExternalId($postingListItem->getAttribute('id'));
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

            $progressBar->advance();

            sleep(1);
        }

        $progressBar->finish();
        $this->output->newLine(2);

        return $listings;
    }

    /**
     * @throws \Exception
     */
    private function setSalary(Listing $listing, string $salaryRawText): void
    {
        $salaryParts = explode(' ', trim($salaryRawText));

        if (count($salaryParts) >= 5) {
            $salaryType = $salaryParts[0];
            $salaryLow = $salaryParts[1];
            $salaryHigh = $salaryParts[3];
            $salaryCurrency = $salaryParts[4];
        } elseif (3 == count($salaryParts)) {
            $salaryType = $salaryParts[0];
            $salaryLow = $salaryParts[1];
            $salaryHigh = $salaryParts[1];
            $salaryCurrency = $salaryParts[2];
        } elseif (count($salaryParts) >= 4) {
            $salaryType = $salaryParts[0];
            $salaryCurrency = $salaryParts[3];

            preg_match_all('/[0-9]+/', $salaryRawText, $matches);
            $salaryLow = implode('', $matches[0]);
            $salaryHigh = implode('', $matches[0]);
        } else {
            throw new \Exception(sprintf('Unknown salary format. Raw value: %s', $salaryRawText));
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
