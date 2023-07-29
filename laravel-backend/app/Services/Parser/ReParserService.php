<?php

namespace App\Services\Parser;

use App\Models\JobListing;

class ReParserService
{
    private HumanAdvertisementParser $advertisementParser;

    public function __construct(HumanAdvertisementParser $advertisementParser)
    {
        $this->advertisementParser = $advertisementParser;
    }

    public function reparse(JobListing $listing): void
    {
        $category = $this->advertisementParser->parseJobTitle($listing->name);

        $listing->level = $category->getLevel();
        $listing->position = $category->getPosition();
        $listing->stack = $category->getStack();
        $listing->save();
    }
}
