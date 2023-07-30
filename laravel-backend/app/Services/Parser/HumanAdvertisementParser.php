<?php

namespace App\Services\Parser;

use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\JobStack;
use App\Services\Parser\DTOs\JobCategory;

class HumanAdvertisementParser
{
    protected static array $levels = [];

    protected static array $stacks = [];

    protected static array $positions = [];

    public function __construct()
    {
        if ([] === self::$levels) {
            /** @var JobLevel $item */
            foreach (JobLevel::all() as $item) {
                self::$levels[$item->name] = $item->keywords;
            }
        }

        if ([] === self::$stacks) {
            /** @var JobStack $item */
            foreach (JobStack::all() as $item) {
                self::$stacks[$item->name] = [
                    'keywords' => $item->keywords,
                    'defaultPosition' => $item->jobPosition ? $item->jobPosition->name : null,
                ];
            }
        }

        if ([] === self::$positions) {
            /** @var JobPosition $item */
            foreach (JobPosition::all() as $item) {
                self::$positions[$item->name] = $item->keywords;
            }
        }
    }

    public function parseJobTitle(string $title): JobCategory
    {
        $titleParts = explode(' ', str_replace(['(', ')', '/', ','], ' ', mb_strtolower($title)));
        $jobCategory = new JobCategory();

        foreach (self::$levels as $level => $keywords) {
            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setLevel($level);
                    break 2;
                }
            }
        }

        foreach (self::$positions as $position => $keywords) {
            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setPosition($position);
                    break 2;
                }
            }
        }

        foreach (self::$stacks as $stack => $stackData) {
            $keywords = $stackData['keywords'];

            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setStack($stack);
                    break 2;
                }
            }
        }

        // Use the fallback position if stack is available
        if (null === $jobCategory->getPosition() && null !== $jobCategory->getStack()) {
            $jobCategory->setPosition(self::$stacks[$jobCategory->getStack()]['defaultPosition']);
        }

        return $jobCategory;
    }
}
