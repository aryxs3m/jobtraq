<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentListRequest;
use App\Http\Requests\Admin\UpdateCommentOpStatusRequest;
use App\Http\Requests\Admin\UpdateCommentStatusRequest;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function listComments(CommentListRequest $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $commentsQuery = Comment::query();

        if ($request->has('status') && null !== $request->validated('status')) {
            $commentsQuery->where('status', $request->validated('status'));
        }

        if ($request->has('article_id')) {
            $commentsQuery->where('article_id', '=', $request->validated('article_id'));
        }

        $comments = $commentsQuery->paginate();

        return view('comments.list', [
            'comments' => $comments,
            'status_filter' => $request->validated('status'),
        ]);
    }

    public function updateCommentStatus(UpdateCommentStatusRequest $request): JsonResponse
    {
        try {
            $comment = Comment::query()->find($request->validated('comment_id'));
            $comment->status = $request->validated('status');
            $comment->save();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $throwable) {
            return response()->json([
                'success' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }

    public function updateCommentOpStatus(UpdateCommentOpStatusRequest $request): JsonResponse
    {
        try {
            $comment = Comment::query()->find($request->validated('comment_id'));
            $comment->is_op = $request->validated('is_op');
            $comment->save();

            return response()->json([
                'success' => true,
                'is_op' => $comment->is_op,
            ]);
        } catch (\Throwable $throwable) {
            return response()->json([
                'success' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
