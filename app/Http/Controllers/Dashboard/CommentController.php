<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\PostCommented;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post){

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id; 
        $comment->save();

        PostCommented::dispatch(auth()->user(), $comment);
        return redirect()->route('dashboard.posts.show', $post->id)->with('success', 'Comentario creado correctamente');
    }

    public function destroy(Comment $comment){
        if($comment->isReply()){
            $id = $comment->commentParent->post_id;
        }
        else{
            $id = $comment->post_id;
        }
        $comment->delete();
        return redirect()->route('dashboard.posts.show', $id)->with('success', 'Comentario eliminado correctamente');
    }

    public function reply(Comment $comment){
        $reply = new Comment();
        $reply->content = request('content');
        $reply->user_id = auth()->id(); 
        $reply->parent_id = $comment->id;
        $reply->save();
        

        return redirect()->route('dashboard.posts.show', $comment->post_id)->with('success', 'Comentario creado correctamente');
    }
}
