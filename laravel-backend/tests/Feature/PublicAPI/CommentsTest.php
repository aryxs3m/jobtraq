<?php

namespace PublicAPI;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Enums\CommentStatus;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanPostNewComment(): void
    {
        $article = Article::factory()->create();

        $response = $this->post('/api/comments/new', [
            'name' => 'Commenter',
            'message' => 'Test message',
            'slug' => $article->slug,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'data' => [
                'id' => 1,
                'status' => CommentStatus::AWAITING_MODERATION->value,
            ],
        ]);
    }

    public function testCanGetComments(): void
    {
        $article = Article::factory()->create();

        $comment = Comment::factory()->approved()->make();
        $comment->article_id = $article->id;
        $comment->save();

        $commentDenied = Comment::factory()->denied()->make();
        $commentDenied->article_id = $article->id;
        $commentDenied->save();

        $response = $this->get("/api/comments?slug={$article->slug}");

        $response->assertStatus(200);
        $response->assertSimilarJson([
            'status' => 'success',
            'data' => [[
                'name' => $comment->name,
                'message' => $comment->message,
                'created_at' => $comment->created_at,
                'is_op' => 0,
            ]],
        ]);
        $response->assertJsonCount(1, 'data');
    }
}
