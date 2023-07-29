<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class HealthcheckController extends BaseApiController
{
    public function status(): JsonResponse
    {
        return $this->success([
            'frontend' => true,
            'backend' => true,
            'crawlers' => [
                [
                    'name' => 'NoFluffJobs',
                    'status' => true,
                ],
                [
                    'name' => 'Profession',
                    'status' => true,
                ],
            ]
        ]);
    }
}
