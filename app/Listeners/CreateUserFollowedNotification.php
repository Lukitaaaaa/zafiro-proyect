<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\Models\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserFollowedNotification
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
    public function manage(UserFollowed $event): void
    {
        Notification::create([
            'user_id' => $event->followed->id,
            'type' => 'follow',
            'actor_id' => $event->follower->id,
        ]);
    }
}
