<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePostCommentedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function manage(PostCommented $event): void
    {
        $post = Post::find($event->comment->post_id);
        if ($event->actor->id === $post->user_id) {
            return;
        }

        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'comment',
            'actor_id' => $event->actor->id,
            'post_id' => $event->comment->post_id,
            'comment_id' => $event->comment->id,
        ]);
    }
}
