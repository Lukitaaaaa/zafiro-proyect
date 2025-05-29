<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $userAuth = auth()->user();
        
        $posts = Post::with(['user'])->withCount(['likes', 'comments'])->orderBy('created_at','DESC')->get();

        $users = User::where('id', '!=', $userAuth->id)
                ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
                ->orderBy('created_at','DESC')
                ->take(5)
                ->get();

        return view('dashboard.home', compact('posts', 'users'));

    }

    public function explore(){

        $posts = Post::with(['user'])->withCount(['likes', 'comments'])->orderBy('created_at','DESC')->get();
        return view('dashboard.explore', compact('posts'));
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
        $posts = $user->likes()->with('user')->withCount(['likes', 'comments'])->get();

        return view('dashboard.liked-posts', compact('posts'));
    }

    public function settings() {
        return view('dashboard.settings');
    }

    public function searchUsers(Request $request) {
        
        $query = $request->input('q');
        $usuarios = User::where('username', 'LIKE', '%'. $query .'%')
                ->orderBy('created_at','DESC')
                ->take(7)
                ->get();

        return response()->json($usuarios);
    }
}
