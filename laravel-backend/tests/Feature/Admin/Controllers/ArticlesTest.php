<?php

namespace Admin\Controllers;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewArticle(): void
    {
        $user = $this->createAdministratorUser();

        $this->actingAs($user)->post('/articles', [
            'published' => 1,
            'title' => 'Test Article',
            'content' => 'This is the **test** content.',
            'introduction' => 'This is the test introduction.',
            'image_url' => 'https://example.org/image.jpg',
        ]);

        $this->assertDatabaseHas(Article::class, [
            'title' => 'Test Article',
            'user_id' => $user->id,
        ]);
    }

    public function testCanEditArticle(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Article $article */
        $article = Article::factory()->create();

        $response = $this->actingAs($user)->get("/articles/{$article->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('Hírek');

        $this->actingAs($user)->put("/articles/{$article->id}", [
            'published' => 1,
            'content' => 'This is the **test** content.',
            'introduction' => 'This is the test introduction.',
            'image_url' => 'https://example.org/image.jpg',
            'title' => 'This is the new title.',
        ]);

        $this->assertDatabaseHas(Article::class, [
            'title' => 'This is the new title.',
        ]);
    }

    public function testCanShowArticle(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Article $article */
        $article = Article::factory()->create();

        $response = $this->actingAs($user)->get('/articles', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($article->id);
    }
}
