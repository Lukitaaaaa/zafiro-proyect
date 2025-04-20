<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $userAuth = auth()->user();

        $posts = Post::orderBy('created_at','DESC')->get();
        $users = User::where('id', '!=', $userAuth->id)
                ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
                ->orderBy('created_at','DESC')
                ->take(5)
                ->get();

        return view('dashboard.home', compact('posts', 'users'));

    }

    public function showUsers(){

        $userAuth = auth()->user();
        
        $users = User::where('id', '!=', $userAuth->id)
                ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
                ->orderBy('created_at','DESC')
                ->get();

        return view('dashboard.show-users', compact('users'));
    }

    public function likedPosts() {
        $user = auth()->user();

        // Obtener los posts que el usuario ha "likeado"
        $posts = $user->likes()->with('user')->get();

        return view('dashboard.liked-posts', compact('posts'));
    }

    public function settings() {
        return view('dashboard.settings');
    }
}
