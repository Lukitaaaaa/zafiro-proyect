<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard.home', [
            'posts' => Post::orderBy('created_at','DESC')->get()
        ]);

    }
}
