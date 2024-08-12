<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        
        // $post = new Post([
        //     'description' => 'hello',
        //     'image' => ''
        // ]);

        // $post->save();

        return view('profile', [
            'posts' => Post::orderBy('created_at','DESC')->get()
        ]);

    }
}
