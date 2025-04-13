<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard.home', [
            'posts' => Post::orderBy('created_at','DESC')->get(),
            'users' => User::orderBy('created_at','DESC')->take(5)->get(),
        ]);

    }

    public function showUsers(){
        return view('dashboard.show-users', [
            'users' => User::orderBy('created_at','DESC')->get(),
        ]);
    }
}
