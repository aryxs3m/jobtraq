<?php

namespace App\Http\Controllers\PublicApi\Reports;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\DiffReportRequest;
use App\Http\Requests\PublicApi\LangReportRequest;
use App\Models\Location;
use App\Services\Report\DiffReporter;
use App\Services\Report\HomepageReporter;
use App\Services\Report\LangReporter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class LangReportController extends BaseApiController
{
    /**
     * @throws \Exception
     *
     * @api {get} /report/lang Programozási nyelv kimutatásaival tér vissza
     *
     * @apiDescription Paraméterben megadott programozási nyelvhez tartozó információkkal tér vissza.
     *
     * @apiName GetLangReport
     *
     * @apiGroup Kimutatások
     *
     * @apiVersion 0.1.1
     *
     * @apiQuery {string} lang Programnyelv
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
    public function langReport(LangReportRequest $request, LangReporter $reporter): JsonResponse
    {
        $reporter->setCountryId(Location::LOCATION_HUNGARY);
        return $this->success($reporter->getLangReport($request->validated('lang')));
    }
}
