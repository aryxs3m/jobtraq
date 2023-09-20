<?php

namespace App\Http\Controllers\PublicApi\Integrations;

use App\Http\Controllers\BaseApiController;
use App\Models\JobPosition;
use App\Models\Location;
use App\Services\Report\HomepageReporter;
use Carbon\Carbon;

class HomeAssistantController extends BaseApiController
{
    public function getSensor(HomepageReporter $reporter)
    {
        $reporter->setFilterDate(new Carbon('now'));
        $reporter->setCountryId(Location::LOCATION_HUNGARY);
        $report = $reporter->getHomepageReport();

        return response()->json([
            'total_jobs' => array_sum(array_column($report['pieChartPositions'], 'value')),
            'jobs_count' => $this->jobsByPositions($report['pieChartPositions']),
            'jobs_avg_salary' => $this->jobsByPositions($report['pieChartPositions']),
        ]);
    }

    private function jobsByPositions(array $pieChartPositions): array
    {
        $output = [];

        /** @var JobPosition $item */
        foreach (JobPosition::all() as $item) {
            foreach ($pieChartPositions as $pieChartPosition) {
                if ($pieChartPosition->name === $item->name) {
                    $output[$item->name] = $pieChartPosition->value;
                    break;
                }
            }

            if (!\array_key_exists($item->name, $output)) {
                $output[$item->name] = 0;
            }
        }

        return $output;
    }
}
