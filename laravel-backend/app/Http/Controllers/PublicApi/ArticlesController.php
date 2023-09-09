<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\ArticleListRequest;
use App\Http\Requests\PublicApi\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticlesController extends BaseApiController
{
    /**
     * @api {get} /articles Hírek listázása
     *
     * @apiName ListArticles
     *
     * @apiDescription A legfrissebb, publikált hírek listáját adja vissza.
     *
     * @apiGroup Hírek
     *
     * @apiVersion 0.1.0
     *
     * @apiQuery {integer} limit Limit, max ennyi cikkel tér vissza.
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {integer} data.id azonosító
     * @apiSuccess {string} data.slug slug
     * @apiSuccess {string} data.title cím
     * @apiSuccess {string} data.introduction bevezető szöveg
     * @apiSuccess {string} data.image_url teljes HTTP(S) URL a cikkhez tartozó illusztrációhoz
     * @apiSuccess {date} data.published_at publikálás dátuma
     * @apiSuccess {integer} data.user_id létrehozó személy azonosítója
     */
    public function list(ArticleListRequest $request, ArticleService $articleService): JsonResponse
    {
        return $this->success($articleService->getList($request->validated('limit')));
    }

    /**
     * @api {get} /articles/get Hír lekérése
     *
     * @apiName GetArticle
     *
     * @apiDescription Egy adott hírt ad vissza slug alapján.
     *
     * @apiGroup Hírek
     *
     * @apiVersion 0.1.0
     *
     * @apiQuery {string} slug A hír slugja.
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {integer} data.id azonosító
     * @apiSuccess {date} data.created_at létrehozás ideje
     * @apiSuccess {date} data.updated_at frissítés ideje
     * @apiSuccess {date} data.published_at publikálás dátuma
     * @apiSuccess {boolean} data.published publikált-e?
     * @apiSuccess {string} data.image_url teljes HTTP(S) URL a cikkhez tartozó illusztrációhoz
     * @apiSuccess {string} data.title cím
     * @apiSuccess {string} data.slug slug
     * @apiSuccess {string} data.introduction bevezető szöveg
     * @apiSuccess {string} data.content tartalom, Markdown szöveg
     * @apiSuccess {integer} data.user_id létrehozó személy azonosítója
     */
    public function get(ArticleRequest $request): JsonResponse
    {
        return $this->success(Article::query()
            ->where('slug', '=', $request->validated('slug'))
            ->firstOrFail());
    }
}
