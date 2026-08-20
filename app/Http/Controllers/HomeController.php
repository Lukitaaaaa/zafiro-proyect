<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userAuth = auth()->user();

        // Obtener los posts de los usuarios que el usuario autenticado sigue
        $posts = Post::with(['user'])
            ->withCount(['likes', 'comments'])
            ->whereIn('user_id', $userAuth->followings()->pluck('users.id'))
            ->orderBy('created_at', 'DESC')
            ->get();

        $users = User::where('id', '!=', $userAuth->id)
            ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return view('dashboard.home', compact('posts', 'users'));

    }

    public function explore()
    {
        $userAuth = auth()->user();

        $posts = Post::with(['user'])
            ->withCount(['likes', 'comments'])
            ->orderBy('created_at', 'DESC')->get();

        $users = User::where('id', '!=', $userAuth->id)
            ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        $trendingTags = Tag::trending(5)->get();
        return view('dashboard.explore', compact('posts', 'users', 'trendingTags'));
    }

    public function showUsers()
    {
        $userAuth = auth()->user();

        $users = User::where('id', '!=', $userAuth->id)
            ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('dashboard.show-users', compact('users'));
    }

    public function showTrending()
    {
        $trendingTags = Tag::trending(30)->get();
        return view('dashboard.show-trending', compact('trendingTags'));
    }

    public function likedPosts()
    {
        $user = auth()->user();

        // Obtener los posts que el usuario ha "likeado"
        $posts = $user->likes()->with('user')->withCount(['likes', 'comments'])->get();

        return view('dashboard.liked-posts', compact('posts'));
    }

    public function notifications()
    {
        $notidications = auth()->user()->unreadNotifications();
        foreach ($notidications as $notification) {
            $notification->read = true;
            $notification->save();
        }
        return view('dashboard.notifications');
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function postsByTag(Tag $tag)
    {
        $userAuth = auth()->user();

        $posts = $tag->posts()
            ->with('user')
            ->withCount(['likes', 'comments'])
            ->orderBy('created_at', 'DESC')
            ->get();

        $users = User::where('id', '!=', $userAuth->id)
            ->whereNotIn('id', $userAuth->followings()->pluck('users.id'))
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        $trendingTags = Tag::trending(5)->get();

        return view('dashboard.explore', compact('posts', 'users', 'trendingTags', 'tag'));
    }

    public function searchUsers(Request $request)
    {

        $query = $request->input('q');
        $usuarios = User::where('username', 'LIKE', '%' . $query . '%')
            ->orderBy('created_at', 'DESC')
            // ->take(5)
            ->get();

        return response()->json($usuarios);
    }
}
