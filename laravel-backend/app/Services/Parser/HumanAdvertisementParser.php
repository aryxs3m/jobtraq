<?php

namespace App\Services\Parser;

use App\Services\Parser\DTOs\JobCategory;

class HumanAdvertisementParser
{
    private const LEVELS = [
        'internship' => ['internship', 'intern', 'trainee', 'gyakornok', 'diákmunka'] ,
        'junior' => ['junior'],
        'medior' => ['medior', 'mid'],
        'senior' => ['senior'],
        'lead' => ['lead', 'leader'],
        'architect' => ['architect'],
        'manager' => ['manager'],
    ];

    private const POSITION = [
        'frontend' => ['frontend', 'front-end'],
        'backend' => ['backend', 'back-end', 'api'],
        'analyst' => ['analyst'],
        'data' => ['data'],
        'ml' => ['machine'],
        'embedded' => ['embedded'],
        'full-stack' => ['full-stack', 'fullstack'],
        'support' => ['support', 'l1', 'l2', 'l3'],
        'devops' => ['devops', 'dev-ops'],
        'developer' => ['developer', 'engineer', 'fejlesztő'],
    ];

    private const STACK = [
        'go',
        'php',
        'java',
        'angular',
        'react',
        'node',
        '.net',
        'asp',
        'c#',
        'c++',
        'python',
        'golang',
        'ruby',
        'rust',
        'solidity',
        'rust',
        'mysql',
        'postgresql',
        'postgres'
    ];

    public function parseJobTitle(string $title): JobCategory
    {
        $titleParts = explode(' ', str_replace(['(', ')', '/', ','], ' ', mb_strtolower($title)));
        $jobCategory = new JobCategory();

        foreach (self::LEVELS as $level => $keywords) {
            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setLevel($level);
                    break 2;
                }
            }
        }

        foreach (self::POSITION as $position => $keywords) {
            foreach ($keywords as $keyword) {
                if (\in_array($keyword, $titleParts)) {
                    $jobCategory->setPosition($position);
                    break 2;
                }
            }
        }

        foreach (self::STACK as $stack) {
            if (\in_array($stack, $titleParts)) {
                $jobCategory->setStack($stack);
                break;
            }
        }

        return $jobCategory;
    }
}
