<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\DiscordSubscribeRequest;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class SubscribeController extends BaseApiController
{
    /**
     * @api {post} /subscribe/discord Új Discord webhook feliratkozás
     *
     * @apiName DiscordSubscribe
     *
     * @apiDescription Feliratkoztat egy Discord webhookot a napi riportokra.
     *
     * Ez egy "early-access" funkció, jelenleg a frontend oldalról nem érhető el. A webhook message tartalma
     * előfordulhat, hogy változik a jövőben.
     *
     * Percenként maximum 3 feliratkozást küldhetsz be egy IP címről.
     *
     * @apiGroup Feliratkozások
     *
     * @apiVersion 0.1.0
     *
     * @apiBody {string} webhook_url Discord webhook URL
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {integer} data.id feliratkozás azonosítója
     */
    public function subscribeDiscord(DiscordSubscribeRequest $request): JsonResponse
    {
        $subscription = Subscription::create([
            'type' => 'discord',
            'settings' => [
                'webhook_url' => $request->validated('webhook_url'),
            ],
        ]);

        return $this->success([
            'id' => $subscription->id,
        ]);
    }
}
