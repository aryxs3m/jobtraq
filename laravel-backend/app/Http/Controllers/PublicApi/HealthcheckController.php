<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Services\HealthCheckService;
use App\Services\Scraper\ScraperManager;
use Illuminate\Http\JsonResponse;

class HealthcheckController extends BaseApiController
{
    /**
     * @api {get} /healthcheck Healthcheck információk lekérése
     *
     * @apiName GetHealthcheck
     *
     * @apiGroup Healthcheck
     *
     * @apiVersion 0.1.0
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {boolean} data.frontend frontend állapota (mindig true)
     * @apiSuccess {boolean} data.backend backend állapota (mindig true)
     * @apiSuccess {object[]} data.scrapers[] scraperek állapota (mai napon sikeresen lefutottak-e)
     * @apiSuccess {string} data.scrapers.name scraper class neve
     * @apiSuccess {boolean} data.scrapers.status scraper állapota
     */
    public function status(HealthCheckService $healthCheckService, ScraperManager $manager): JsonResponse
    {
        $scraperStatuses = [];
        foreach ($manager->getServices() as $service) {
            $scraperStatuses[] = [
                'name' => class_basename($service),
                'status' => $healthCheckService->checkScraperHealthForToday($service),
            ];
        }

        return $this->success([
            'frontend' => true,
            'backend' => true,
            'scrapers' => $scraperStatuses,
        ]);
    }
}
