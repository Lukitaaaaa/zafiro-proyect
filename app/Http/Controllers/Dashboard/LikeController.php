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
        return response()->json(
        [ 
            'likes_count' => $post->likes()->count(),
            'estatus' => 'isLiked'
        ]);
    }

    public function unlike(Post $post){
        $liker = auth()->user();
        $liker->likes()->detach($post);
        return response()->json(
        [ 
            'likes_count' => $post->likes()->count(),
            'estatus' => 'isUnliked'
        ]);
    }

    public function likeComment(Post $post, Comment $comment){
        $liker = auth()->user();
        $liker->likesComment()->attach($comment);
        return response()->json(
        [ 
            'likes_count' => $comment->likes()->count(),
            'estatus' => 'isLiked'
        ]);
    }

    public function unlikeComment(Post $post, Comment $comment){
        $liker = auth()->user();
        $liker->likesComment()->detach($comment);
        return response()->json(
        [ 
            'likes_count' => $comment->likes()->count(),
            'estatus' => 'isUnliked'
        ]);
    }

    //TODO: SOLUCIONAR EL PROBLEMA DE ACTUALIZAR EL CONTADOR DE LIKES EN LA POST CARD CUANDO SE HACE UNA ACCION Y SE RETROCEDE A LA PAGINA ANTERIOR
}
