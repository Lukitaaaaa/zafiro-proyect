<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post){
        $liker = auth()->user();
        $liker->likes()->attach($post);
        return redirect()->route('dashboard.posts.show', $post->id);
    }

    public function unlike(Post $post){
        $liker = auth()->user();
        $liker->likes()->detach($post);
        return redirect()->route('dashboard.posts.show', $post->id);
    }
}
