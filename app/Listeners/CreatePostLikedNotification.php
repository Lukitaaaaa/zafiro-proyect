<?php

namespace App\Listeners;

use App\Events\PostLiked;
use App\Models\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePostLikedNotification
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
    // public function handle(PostLiked $event): void
    // {
    //      \Log::info('CreatePostLikedNotification::handle called', ['actor' => $event->actor->id, 'post_user' => $event->post->user_id, 'post' => $event->post->id]);
    //     // No notificar si el que da like es el dueño del post
    //     if ($event->actor->id === $event->post->user_id) {
    //         return;
    //     }

    //     Notification::create([
    //         'user_id' => $event->post->user_id,
    //         'type' => 'like',
    //         'actor_id' => $event->actor->id,
    //         'post_id' => $event->post->id,
    //     ]);
    // }

    public function manage(PostLiked $event): void
    {
        // No notificar si el que da like es el dueño del post
        if ($event->actor->id === $event->post->user_id) {
            return;
        }

        Notification::create([
            'user_id' => $event->post->user_id,
            'type' => 'like',
            'actor_id' => $event->actor->id,
            'post_id' => $event->post->id,
        ]);
    }
}
