<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublicApi\DiffReportRequest;
use App\Models\Location;
use App\Services\Report\DiffReporter;
use App\Services\Report\HomepageReporter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiffReportController extends BaseApiController
{
    /**
     * @throws \Exception
     */
    public function diffReport(DiffReportRequest $request, DiffReporter $reporter): JsonResponse
    {
        $firstReporter = HomepageReporter::make()
            ->setCountryId(Location::LOCATION_HUNGARY)
            ->setFilterDate(new Carbon($request->validated('first_date')));

        $secondReporter = HomepageReporter::make()
            ->setCountryId(Location::LOCATION_HUNGARY)
            ->setFilterDate(new Carbon($request->validated('second_date')));

        return $this->success($reporter->diff(
            $firstReporter,
            $secondReporter
        ));
    }
}
