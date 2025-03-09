<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Http\Middleware\Authenticate;

use App\Http\Requests\Dashboard\UpdateProfileRequest;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        
        // $post = new Post([
        //     'description' => 'hello',
        //     'image' => ''
        // ]);

        // $post->save();
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('dashboard.profile', [
            'posts' => $posts
        ]);

    }

    public function edit(){
        return view('dashboard.edit-profile', ['user' => Auth::user()]);
    }

    public function update(UpdateProfileRequest $request){
        $data = $request->safe()->except('image');

        $user = auth()->user()->update($data);

        return view('dashboard.profile', [
            'posts' => Post::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get(),
            'user' => $user
        ]);

    }
}
