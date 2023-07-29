<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class HomeController extends BaseApiController
{
    public function index(): JsonResponse
    {
        return $this->success([
            'system' => [
                'name' => config('app.name'),
                'version' => config('app.version'),
                'environment' => config('app.env'),
            ],
            'contact' => [
                'author' => 'Patrik Tóth',
                'email' => 'info@jobtraq.hu',
            ],
        ]);
    }
}
