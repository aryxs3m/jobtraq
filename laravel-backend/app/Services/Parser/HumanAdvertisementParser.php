<?php

namespace App\Services\Parser;

use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\JobStack;
use App\Models\Location;
use App\Services\Parser\DTOs\JobCategory;

class HumanAdvertisementParser
{
    protected static array $levels = [];

    protected static array $stacks = [];

    protected static array $positions = [];

    protected static array $locations = [];

    public function parseJobTitle(string $title): JobCategory
    {
        $this->initParserData();

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

        foreach (self::$positions as $position => $settings) {
            foreach ($settings['keywords'] as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setPosition($position);

                    foreach ($settings['sub_positions'] as $subPosition) {
                        foreach ($subPosition['keywords'] as $subKeyword) {
                            if (\in_array($subKeyword, $titleParts)) {
                                $jobCategory->setPosition($subPosition['name']);
                                break 4;
                            }
                        }
                    }

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

    public function parseJobLocation(string $location): ?int
    {
        $this->initParserData();

        $locationParts = explode(' ', str_replace(',', '', mb_strtolower($location)));

        foreach (self::$locations as $locationName => $locationId) {
            if (\in_array(mb_strtolower($locationName), $locationParts)) {
                return $locationId;
            }
        }

        return null;
    }

    protected function initParserData(): void
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
            /** @var JobPosition[] $jobPositions */
            $jobPositions = JobPosition::query()->whereNull('job_position_id')->get();
            foreach ($jobPositions as $item) {
                self::$positions[$item->name] = [
                    'keywords' => $item->keywords,
                    'sub_positions' => $item->jobPositions->map(function (JobPosition $position) {
                        return [
                            'name' => $position->name,
                            'keywords' => $position->keywords,
                        ];
                    }),
                ];
            }
        }

        if ([] === self::$locations) {
            /** @var Location $item */
            foreach (Location::all() as $item) {
                self::$locations[$item->location] = $item->id;
            }
        }
    }
}
