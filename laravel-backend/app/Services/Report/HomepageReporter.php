<?php

namespace App\Services\Report;

use App\Models\JobPosition;

class HomepageReporter extends PublicReporter
{
    /**
     * @throws \Exception
     */
    public function getHomepageReport(): array
    {
        return [
            'isDataReady' => $this->isDataReady(),
            'pieChartPositions' => $this->getJobsCountByPosition(),
            'barOpenPositions' => $this->getJobsCountByWeek(),
            'treeMapStacks' => $this->getJobsCountByStack(),
            'positionSalaries' => $this->getPositionSalaries(),
            'barStacks' => $this->getAverageSalariesByStacksByLevels(),
        ];
    }

    private function getPositionSalaries(): array
    {
        $return = [];

        foreach (JobPosition::notHidden()->get() as $item) {
            $return[] = [
                'name' => $item->name,
                'data' => $this->getAverageSalariesByLevels($item->name),
            ];
        }

        return $return;
    }
}
