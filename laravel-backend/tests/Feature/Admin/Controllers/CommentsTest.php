<?php

namespace Admin\Controllers;

use App\Models\Comment;
use App\Models\Enums\CommentStatus;
use App\Models\User;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanListComments(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $awaitingComment */
        $awaitingComment = Comment::factory()->create();

        /** @var Comment $approvedComment */
        $approvedComment = Comment::factory()->approved()->create();

        /** @var Comment $deniedComment */
        $deniedComment = Comment::factory()->denied()->create();

        $response = $this->actingAs($user)->get('/comments');

        $response->assertSee($awaitingComment->name);
        $response->assertSee($awaitingComment->message);
        $response->assertSee($awaitingComment->ip_address);
        $response->assertSee($deniedComment->name);
        $response->assertSee($deniedComment->message);
        $response->assertSee($deniedComment->ip_address);
        $response->assertSee($approvedComment->name);
        $response->assertSee($approvedComment->message);
        $response->assertSee($approvedComment->ip_address);
    }

    public function testCanListCommentsApproved(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        /** @var Comment $approvedComment */
        $approvedComment = Comment::factory()->approved()->create();

        $response = $this->actingAs($user)->get('/comments?status=APPROVED');

        $response->assertSee($approvedComment->name);
        $response->assertSee($approvedComment->message);
        $response->assertSee($approvedComment->ip_address);

        $response->assertDontSee($comment->name);
        $response->assertDontSee($comment->message);
        $response->assertDontSee($comment->ip_address);
    }

    public function testCanListCommentsDenied(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        /** @var Comment $deniedComment */
        $deniedComment = Comment::factory()->denied()->create();

        $response = $this->actingAs($user)->get('/comments?status=DENIED');

        $response->assertSee($deniedComment->name);
        $response->assertSee($deniedComment->message);
        $response->assertSee($deniedComment->ip_address);

        $response->assertDontSee($comment->name);
        $response->assertDontSee($comment->message);
        $response->assertDontSee($comment->ip_address);
    }

    public function testCanListCommentsAwaiting(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->denied()->create();

        /** @var Comment $awaitingComment */
        $awaitingComment = Comment::factory()->create();

        $response = $this->actingAs($user)->get('/comments?status=AWAITING_MODERATION');

        $response->assertSee($awaitingComment->name);
        $response->assertSee($awaitingComment->message);
        $response->assertSee($awaitingComment->ip_address);

        $response->assertDontSee($comment->name);
        $response->assertDontSee($comment->message);
        $response->assertDontSee($comment->ip_address);
    }

    public function testCanApproveComment(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->post('/comments/update-moderation', [
            'comment_id' => $comment->id,
            'status' => CommentStatus::APPROVED->value,
        ]);

        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas(Comment::class, [
            'name' => $comment->name,
            'message' => $comment->message,
            'status' => CommentStatus::APPROVED->value,
        ]);
    }

    public function testCanDenyComment(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->post('/comments/update-moderation', [
            'comment_id' => $comment->id,
            'status' => CommentStatus::DENIED->value,
        ]);

        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas(Comment::class, [
            'name' => $comment->name,
            'message' => $comment->message,
            'status' => CommentStatus::DENIED->value,
        ]);
    }

    public function testCanOpComment(): void
    {
        $user = $this->createAdministratorUser();

        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->post('/comments/update-op', [
            'comment_id' => $comment->id,
            'is_op' => true,
        ]);

        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas(Comment::class, [
            'name' => $comment->name,
            'message' => $comment->message,
            'is_op' => 1,
        ]);
    }
}
