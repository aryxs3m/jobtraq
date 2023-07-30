<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Services\HealthCheckService;
use App\Services\Scraper\ScraperManager;
use Illuminate\Http\JsonResponse;

class HealthcheckController extends BaseApiController
{
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
