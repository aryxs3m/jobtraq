<?php

namespace App\Http\Controllers\PublicApi;

use App\Events\CommentPosted;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PublicApi\GetCommentsRequest;
use App\Http\Requests\PublicApi\PostCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Enums\CommentStatus;
use Illuminate\Http\JsonResponse;

class CommentsController extends BaseApiController
{
    /**
     * @api {get} /comments Hír hozzászólásainak lekérése
     *
     * @apiName GetComments
     *
     * @apiDescription Hírhez tartozó moderáción elfogadott hozzászólásokat ad vissza.
     *
     * @apiGroup Hozzászólások
     *
     * @apiVersion 0.1.0
     *
     * @apiQuery {string} slug Cikk slugja
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {object[]} data[] Hozzászólások
     * @apiSuccess {string} data.name hozzászóló neve
     * @apiSuccess {string} data.message hozzászólás szövege
     * @apiSuccess {string} data.created_at létrehozás ideje
     */
    public function getComments(GetCommentsRequest $request): JsonResponse
    {
        /** @var Article $article */
        $article = Article::query()->where('slug', '=', $request->validated('slug'))->firstOrFail();

        return $this->success(
            $article->comments()
                ->where('status', '=', CommentStatus::APPROVED)
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function (Comment $comment) {
                    return [
                        'name' => $comment->name,
                        'message' => $comment->message,
                        'created_at' => $comment->created_at,
                        'is_op' => $comment->is_op,
                    ];
                })
        );
    }

    /**
     * @api {post} /comments/new Új hozzászólás rögzítése
     *
     * @apiName NewComment
     *
     * @apiDescription Hírhez rögzít új hozzászólást.
     *
     * Percenként maximum 5 hozzászólást küldhetsz be egy IP címről.
     *
     * @apiGroup Hozzászólások
     *
     * @apiVersion 0.1.0
     *
     * @apiBody {string} name Hozzászóló neve
     * @apiBody {string} message Üzenet szövege
     * @apiBody {string} slug Cikk slugja
     *
     * @apiSuccess {string} status
     * @apiSuccess {object} data
     * @apiSuccess {integer} data.id azonosító
     * @apiSuccess {string} data.status hozzászólás (moderálási) állapota
     */
    public function newComment(PostCommentRequest $request): JsonResponse
    {
        /** @var Comment $comment */
        $comment = Comment::make($request->validated());
        $comment->article_id = Article::query()
            ->where('slug', '=', $request->validated('slug'))
            ->firstOrFail()
            ->id;
        $comment->ip_address = $request->ip();
        $comment->status = CommentStatus::AWAITING_MODERATION;
        $comment->save();

        CommentPosted::dispatch($comment);

        return $this->success([
            'id' => $comment->id,
            'status' => $comment->status,
        ]);
    }
}
