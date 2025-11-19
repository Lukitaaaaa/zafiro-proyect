<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
use App\Events\PostLiked;

class LikeController extends Controller
{
    public function like(Post $post){
        \Log::info('LikeController::like called', ['user' => auth()->id(), 'post' => $post->id]);

        $liker = auth()->user();
        $liker->likes()->attach($post);

        // event(new PostLiked($liker, $post));
        PostLiked::dispatch($liker, $post);
        return redirect()->route('dashboard.posts.show', $post->id);
    }

    public function unlike(Post $post){
        $liker = auth()->user();
        $liker->likes()->detach($post);
        return redirect()->route('dashboard.posts.show', $post->id);
    }

    public function likeComment(Post $post, Comment $comment){
        $liker = auth()->user();
        $liker->likesComment()->attach($comment);
        return redirect()->route('dashboard.posts.show', $post->id);
    }

    public function unlikeComment(Post $post, Comment $comment){
        $liker = auth()->user();
        $liker->likesComment()->detach($comment);
        return redirect()->route('dashboard.posts.show', $post->id);
    }

    //TODO: SOLUCIONAR EL PROBLEMA DE ACTUALIZAR EL CONTADOR DE LIKES EN LA POST CARD CUANDO SE HACE UNA ACCION Y SE RETROCEDE A LA PAGINA ANTERIOR
}
