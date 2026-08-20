<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\PostCommented;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id; 
        $comment->save();

        PostCommented::dispatch(auth()->user(), $comment);
        
        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
            'comment_html' => view('components.comment', ['comment' => $comment, 'post' => $post])->render()
        ]);
    }

    public function destroy(Comment $comment){
        Gate::authorize('delete', $comment);

        if($comment->isReply()){
            $id = $comment->commentParent->post_id;
        }
        else{
            $id = $comment->post_id;
        }
        $comment->delete();
        $post = Post::find($id);
        $commentParent = Comment::find($comment->parent_id);
        
        return response()->json([
            'success' => true,
            'comments_count' => $post->comments()->count(),
            'replies_count' => $commentParent ? $commentParent->replies()->count() : 0,
            'is_reply' => $comment->isReply(),
        ]);
    }

    public function reply(Request $request, Comment $comment){
        
        $post = Post::find($comment->post_id);
        $reply = new Comment();
        $reply->content = request('content');
        $reply->user_id = auth()->id(); 
        $reply->parent_id = request('parent_id') ?? $comment->id;
        // $reply->post_id = $post->id;
        $reply->save();
        
        return response()->json([
            'success' => true,
            'reply' => $reply->load('user'),
            'reply_html' => view('components.comment', ['comment' => $reply, 'post' => $post])->render()
        ]);
    }
}
