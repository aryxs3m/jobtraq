<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\DiscordSubscribeRequest;
use App\Http\Requests\PublicApi\SearchRequest;
use App\Models\JobStack;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class StackSearchController extends BaseApiController
{
    /**
     * @api {post} /search/stack Stackek között keres
     *
     * @apiName StackSearch
     *
     * @apiDescription A megadott kulcsszóra illeszkedő stackek listájával tér vissza.
     *
     * @apiGroup Keresés
     *
     * @apiVersion 0.1.1
     *
     * @apiQuery {string} keyword Keresési kulcsszó
     *
     * @apiSuccess {array} stacks
     */
    public function searchStack(SearchRequest $request): JsonResponse
    {
        $keyword = $request->validated('keyword');

        $jobStack = JobStack::query()
            ->where('name', 'LIKE', "%$keyword%");

        return $this->success([
            'stacks' => $jobStack->pluck('name'),
        ]);
    }
}
