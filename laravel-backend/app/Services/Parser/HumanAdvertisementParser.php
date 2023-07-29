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
            foreach (JobLevel::all() as $item) {
                self::$levels[$item->name] = $item->keywords;
            }
        }

        if ([] === self::$stacks) {
            foreach (JobStack::all() as $item) {
                self::$stacks[$item->name] = $item->keywords;
            }
        }

        if ([] === self::$positions) {
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

        foreach (self::$stacks as $stack => $keywords) {
            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setStack($stack);
                    break 2;
                }
            }
        }

        return $jobCategory;
    }
}
