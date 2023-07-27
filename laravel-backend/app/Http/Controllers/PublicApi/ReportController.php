<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Services\Report\PublicReporter;
use Illuminate\Http\JsonResponse;

class ReportController extends BaseApiController
{
    public function statisticByPosition(PublicReporter $reporter): JsonResponse
    {
        return $this->success($reporter->getAverageSalariesByPositions());
    }
}
