<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        // Comment author can delete it
        if ($user->id === $comment->user_id) {
            return true;
        }

        // Post author can delete it (moderation)
        if ($comment->isReply()) {
            return $user->id === $comment->commentParent->post->user_id;
        }

        return $user->id === $comment->post->user_id;
    }
}
