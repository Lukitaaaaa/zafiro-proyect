<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Http\Middleware\Authenticate;

use App\Http\Requests\Dashboard\UpdateProfileRequest;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user){
        
        // $post = new Post([
        //     'description' => 'hello',
        //     'image' => ''
        // ]);

        // $post->save();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at','DESC')->get();
        return view('dashboard.profile.index', [
            'posts' => $posts,
            'user' => $user
        ]);

    }

    public function edit(){
        return view('dashboard.profile.edit', ['user' => Auth::user()]);
    }

    public function update(UpdateProfileRequest $request){
        $data = $request->safe()->except('image');
        if($request->hasFile('image')){
            $data['image'] = Storage::disk('users')->put('users', $request->file('image'));
        }
        $user = auth()->user()->update($data);

        return view('dashboard.profile.index', [
            'posts' => Post::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get(),
            'user' => $user
        ]);

    }

    public function follow(User $user){

        $follower = auth()->user();

        $follower->followings()->attach($user);
        return redirect()->route('dashboard.profile', $user);
    }

    public function unfollow(User $user){

        $follower = auth()->user();

        $follower->followings()->detach($user);
        return redirect()->route('dashboard.profile', $user);
    }
}
