<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class HomeController extends BaseApiController
{
    /**
     * @api {get} / API és környezeti információk lekérése
     *
     * @apiName JobTraq
     *
     * @apiGroup Rendszer
     *
     * @apiVersion 0.1.0
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {object} data.system alkalmazás információk
     * @apiSuccess {string} data.system.name alkalmazás neve
     * @apiSuccess {string} data.system.version alkalmazás verziószáma
     * @apiSuccess {string} data.system.environment alkalmazás környezete
     * @apiSuccess {object} data.contact kapcsolatfelvételi információk
     * @apiSuccess {string} data.contact.author fejlesztő neve
     * @apiSuccess {string} data.contact.email fejlesztő e-mail címe
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
