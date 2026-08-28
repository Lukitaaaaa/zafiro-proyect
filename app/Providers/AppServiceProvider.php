<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

use App\Events\PostCommented;
use App\Listeners\CreatePostCommentedNotification;
use App\Events\PostLiked;
use App\Listeners\CreatePostLikedNotification;
use App\Events\UserFollowed;
use App\Listeners\CreateUserFollowedNotification;
use Illuminate\Auth\Notifications\ResetPassword;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return route('auth.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);
        });

        Event::listen(
            PostLiked::class,
            [CreatePostLikedNotification::class, 'manage']
        );

        Event::listen(
            UserFollowed::class,
            [CreateUserFollowedNotification::class, 'manage']
        );

        Event::listen(
            PostCommented::class,
            [CreatePostCommentedNotification::class, 'manage']
        );
    }
}
