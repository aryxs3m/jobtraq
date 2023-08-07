<?php

namespace App\Services\Scraper\DTOs;

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

    private int $locationId;

    private string $externalId;

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function getHomeOfficeDays(): int
    {
        return $this->homeOfficeDays;
    }

    public function setHomeOfficeDays(int $homeOfficeDays): void
    {
        $this->homeOfficeDays = $homeOfficeDays;
    }

    public function getSalaryType(): SalaryType
    {
        return $this->salaryType;
    }

    public function setSalaryType(SalaryType $salaryType): void
    {
        $this->salaryType = $salaryType;
    }

    public function getSalaryLow(): float
    {
        return $this->salaryLow;
    }

    public function setSalaryLow(float $salaryLow): void
    {
        $this->salaryLow = $salaryLow;
    }

    public function getSalaryHigh(): float
    {
        return $this->salaryHigh;
    }

    public function setSalaryHigh(float $salaryHigh): void
    {
        $this->salaryHigh = $salaryHigh;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getSalaryCurrency(): string
    {
        return $this->salaryCurrency;
    }

    public function setSalaryCurrency(string $salaryCurrency): void
    {
        $this->salaryCurrency = $salaryCurrency;
    }

    public function getCategory(): JobCategory
    {
        return $this->category;
    }

    public function setCategory(JobCategory $category): void
    {
        $this->category = $category;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }
}
