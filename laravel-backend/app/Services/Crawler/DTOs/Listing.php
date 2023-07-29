<?php

namespace App\Services\Crawler\DTOs;

use App\Services\Parser\DTOs\JobCategory;

class Listing
{
    private string $position;
    private SalaryType $salaryType;
    private int $salaryLow;
    private int $salaryHigh;
    private string $salaryCurrency;
    private int $homeOfficeDays = 0;
    private string $location;
    private JobCategory $category;

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     */
    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getHomeOfficeDays(): int
    {
        return $this->homeOfficeDays;
    }

    /**
     * @param int $homeOfficeDays
     */
    public function setHomeOfficeDays(int $homeOfficeDays): void
    {
        $this->homeOfficeDays = $homeOfficeDays;
    }

    /**
     * @return SalaryType
     */
    public function getSalaryType(): SalaryType
    {
        return $this->salaryType;
    }

    /**
     * @param SalaryType $salaryType
     */
    public function setSalaryType(SalaryType $salaryType): void
    {
        $this->salaryType = $salaryType;
    }

    /**
     * @return float
     */
    public function getSalaryLow(): float
    {
        return $this->salaryLow;
    }

    /**
     * @param float $salaryLow
     */
    public function setSalaryLow(float $salaryLow): void
    {
        $this->salaryLow = $salaryLow;
    }

    /**
     * @return float
     */
    public function getSalaryHigh(): float
    {
        return $this->salaryHigh;
    }

    /**
     * @param float $salaryHigh
     */
    public function setSalaryHigh(float $salaryHigh): void
    {
        $this->salaryHigh = $salaryHigh;
    }


    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getSalaryCurrency(): string
    {
        return $this->salaryCurrency;
    }

    /**
     * @param string $salaryCurrency
     */
    public function setSalaryCurrency(string $salaryCurrency): void
    {
        $this->salaryCurrency = $salaryCurrency;
    }

    /**
     * @return JobCategory
     */
    public function getCategory(): JobCategory
    {
        return $this->category;
    }

    /**
     * @param JobCategory $category
     */
    public function setCategory(JobCategory $category): void
    {
        $this->category = $category;
    }
}
