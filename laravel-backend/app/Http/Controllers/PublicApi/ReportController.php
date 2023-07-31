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
    /**
     * @throws \Exception
     *
     * @api {get} /report/homepage Napi kimutatás
     * @apiDescription A jobtraq.hu frontendjén megjelenő egy naphoz tartozó minden adat.
     * @apiName JobTraq
     * @apiGroup Kimutatások
     * @apiVersion 0.1.0
     *
     * @apiQuery {Date} [date] Dátumszűrés. Alapértelmezett értéke a mai nap. Formátuma: 2018-09-21
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {boolean} data.isDataReady azt jelzi, hogy van-e a kért naphoz adat
     * @apiSuccess {object[]} data.pieChartPositions[] nyitott álláshirdetések pozíciónként csoportosítva
     * @apiSuccess {string} data.pieChartPositions.name pozíció neve
     * @apiSuccess {integer} data.pieChartPositions.value álláshirdetések száma
     * @apiSuccess {object[]} data.barOpenPositions[] aktuális és attól számított korábbi 3 hét álláshirdetéseinek száma
     * @apiSuccess {integer} data.barOpenPositions.name naptári hét sorszáma
     * @apiSuccess {integer} data.barOpenPositions.value álláshirdetések száma
     * @apiSuccess {object[]} data.treeMapStacks[] nyitott álláshirdetésekben keresett stackek gyakorisága
     * @apiSuccess {string} data.treeMapStacks.name stack neve
     * @apiSuccess {integer} data.treeMapStacks.value álláshirdetések száma
     * @apiSuccess {object[]} data.positionSalaries[] pozíciónkénti átlagos fizetések, minden pozícióra, amihez a napon van nyitott álláshirdetés
     * @apiSuccess {string} data.positionSalaries.name pozíció neve
     * @apiSuccess {object[]} data.positionSalaries.data[] pozícióhoz kapcsolódó adatok
     * @apiSuccess {string} data.positionSalaries.data.name szint neve
     * @apiSuccess {integer} data.positionSalaries.data.value átlagos fizetés
     * @apiSuccess {object[]} data.barStacks[] átlagfizetések stackenkénti és pozíciónkénti csoportosításban
     * @apiSuccess {string} data.barStacks.name stack neve
     * @apiSuccess {object[]} data.barStacks.series[] stackhez kapcsolódó adatok
     * @apiSuccess {string} data.barStacks.series.name szint neve
     * @apiSuccess {integer} data.barStacks.series.value átlagos fizetés
     */
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
