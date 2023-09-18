<?php

namespace App\Listeners\Admin;

use App\Events\CommentPosted;
use Illuminate\Support\Facades\Log;

class CommentPostNotification
{
    /**
     * Handle the event.
     */
    public function handle(CommentPosted $event): void
    {
        Log::channel('discord')->info('New comment.', [
            'article' => $event->comment->article->slug,
            'name' => $event->comment->name,
            'message' => $event->comment->message,
        ]);
    }
}
