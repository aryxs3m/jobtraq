<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\HomePageRequest;
use App\Models\JobPosition;
use App\Services\Report\PublicReporter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ReportController extends BaseApiController
{
    public function homepageStatistics(HomePageRequest $request, PublicReporter $reporter): JsonResponse
    {
        $reporter->setFilterDate(new Carbon($request->get('date', 'now')));

        return $this->success([
            'isDataReady' => $reporter->isDataReady(),
            'pieChartPositions' => $reporter->getJobsCountByPosition(),
            'barOpenPositions' => $reporter->getJobsCountByWeek(),
            'treeMapStacks' => $reporter->getJobsCountByStack(),
            'positionSalaries' => $this->getPositionSalaries($reporter),
            'barStacks' => $reporter->getAverageSalariesByStacksByLevels(),
        ]);
    }

    public function statisticByPosition(PublicReporter $reporter): JsonResponse
    {
        return $this->success($reporter->getAverageSalariesByStacksByLevels());
    }

    private function getPositionSalaries(PublicReporter $reporter): array
    {
        $return = [];

        foreach (JobPosition::all() as $item) {
            $return[] = [
                'name' => $item->name,
                'data' => $reporter->getAverageSalariesByLevels($item->name),
            ];
        }

        return $return;
    }
}
