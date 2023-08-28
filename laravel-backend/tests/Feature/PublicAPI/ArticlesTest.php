<?php

namespace PublicAPI;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Enums\CommentStatus;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanGetArticlesList(): void
    {
        $article = Article::factory()->create();

        $response = $this->get('/api/articles?limit=3');

        $response->assertStatus(200);
        $response->assertSimilarJson([
            'status' => 'success',
            'data' => [[
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $article->title,
                'introduction' => $article->introduction,
                'image_url' => $article->image_url,
                'published_at' => $article->published_at,
                'user_id' => $article->user_id,
            ]]
        ]);
        $response->assertJsonCount(1, 'data');
    }

    public function testCanGetArticle(): void
    {
        $article = Article::factory()->create();

        $response = $this->get("/api/articles/get?slug={$article->slug}");

        $response->assertStatus(200);
        $response->assertSimilarJson([
            'status' => 'success',
            'data' => [
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $article->title,
                'introduction' => $article->introduction,
                'image_url' => $article->image_url,
                'published_at' => $article->published_at,
                'published' => 1,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
                'user_id' => $article->user_id,
                'content' => $article->content,
            ]
        ]);
    }
}
