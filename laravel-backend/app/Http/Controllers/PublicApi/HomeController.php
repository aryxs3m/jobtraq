<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class HomeController extends BaseApiController
{
    /**
     * @api {get} / API és környezeti információk lekérése
     * @apiName JobTraq
     * @apiGroup Rendszer
     * @apiVersion 0.1.0
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {object} data.system Alkalmazás információk
     * @apiSuccess {string} data.system.name Alkalmazás neve
     * @apiSuccess {string} data.system.version Alkalmazás verziószáma
     * @apiSuccess {string} data.system.environment Alkalmazás környezete
     * @apiSuccess {object} data.contact Kapcsolatfelvételi információk
     * @apiSuccess {string} data.contact.author Fejlesztő neve
     * @apiSuccess {string} data.contact.email Fejlesztő e-mail címe
     */
    public function index(): JsonResponse
    {
        return $this->success([
            'system' => [
                'name' => config('app.name'),
                'version' => config('app.version'),
                'environment' => config('app.env'),
            ],
            'contact' => [
                'author' => 'PVGA Hackerspace',
                'email' => 'info@jobtraq.hu',
            ],
        ]);
    }
}
