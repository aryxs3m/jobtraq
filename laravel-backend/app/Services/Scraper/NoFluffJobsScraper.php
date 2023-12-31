<?php

namespace App\Services\Scraper;

use App\Services\Scraper\DTOs\Listing;
use App\Services\Scraper\DTOs\SalaryType;
use simplehtmldom\simple_html_dom_node;

class NoFluffJobsScraper extends BaseJobListingScraper
{
    public function scrapePage(string $type): array
    {
        $type = urlencode($type);
        $listings = [];

        $maxPages = 20;

        $progressBar = $this->output->createProgressBar($maxPages);
        $progressBar->start();

        for ($page = 1; $page <= $maxPages; ++$page) {
            $html = $this->downloadPage("https://nofluffjobs.com/hu/{$type}?page={$page}");

            try {
                $items = $html->find('.posting-list-item');

                if (0 === \count($items)) {
                    $this->output->writeln(sprintf(' - Page %s is empty.', $page));
                    break;
                }

                /** @var simple_html_dom_node $postingListItem */
                foreach ($items as $postingListItem) {
                    try {
                        $listing = new Listing();
                        $listing->setPosition($postingListItem->find('.posting-title__position', 0)->plaintext);
                        $listing->setExternalId($postingListItem->getAttribute('href'));

                        $salaryRaw = $postingListItem->find('.salary', 0)->plaintext;
                        $this->setSalary($listing, $salaryRaw);

                        $location = trim($postingListItem->find('.posting-info__location', 0)->plaintext);

                        // Ha a hirdetés távmunkaként szerepel, de van iroda, akkor a további helyszínek popover elemein
                        // végigmegyünk és keresünk egy olyan helyszínt, ami a mi adatbázisunkban is szerepel. Így a
                        // remote pozíciókat is földrajzi helyhez lehet kötni.
                        if (str_contains($location, 'Távmunka')) {
                            $locationsPopover = $postingListItem->next_sibling();

                            foreach ($locationsPopover->find('.popover-body li a') as $item) {
                                $location = trim($item->plaintext);
                                $jobLocationId = $this->advertisementParser->parseJobLocation($location);

                                if ($jobLocationId) {
                                    $listing->setLocation($location);
                                    $listing->setLocationId($jobLocationId);

                                    break;
                                }
                            }
                        }

                        if (!$listing->getLocation()) {
                            $listing->setLocation($location);
                            $listing->setLocationId($this->advertisementParser->parseJobLocation($location));
                        }

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
