<?php

namespace App\Http\Controllers\PublicApi\Reports;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\DiffReportRequest;
use App\Models\Location;
use App\Services\Report\DiffReporter;
use App\Services\Report\HomepageReporter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DiffReportController extends BaseApiController
{
    /**
     * @throws \Exception
     *
     * @api {get} /report/diff Összehasonlító kimutatás lekérése
     *
     * @apiDescription Két megadott dátum napi riportjait hasonlítja össze. Csak azokat az elemeket adja vissza, ahol történt változás.
     *
     * @apiName GetDiffReport
     *
     * @apiGroup Kimutatások
     *
     * @apiVersion 0.1.0
     *
     * @apiQuery {Date} first_date Első riport dátuma
     * @apiQuery {Date} second_date Második riport dátuma
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {object[]} data.pieChartPositions[] pozíciónkénti álláshirdetések
     * @apiSuccess {integer} data.pieChartPositions.first álláshirdetések száma első napon
     * @apiSuccess {integer} data.pieChartPositions.second álláshirdetések száma második napon
     * @apiSuccess {object[]} data.treeMapStacks[] stackenkénti álláshirdetések
     * @apiSuccess {integer} data.treeMapStacks.first álláshirdetések száma első napon
     * @apiSuccess {integer} data.barOpenPositions.second álláshirdetések száma második napon
     * @apiSuccess {object[]} data.positionSalaries[] pozíciónkénti átlagos fizetések, minden pozícióra, amihez a napon van nyitott álláshirdetés
     * @apiSuccess {integer} data.positionSalaries.first átlagos fizetés első napon
     * @apiSuccess {integer} data.positionSalaries.second átlagos fizetés második napon
     * @apiSuccess {object[]} data.barStacks[] átlagfizetések stackenkénti és pozíciónkénti csoportosításban
     * @apiSuccess {integer} data.barStacks.first átlagfizetés első napon
     * @apiSuccess {integer} data.barStacks.second átlagfizetés második napon
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
