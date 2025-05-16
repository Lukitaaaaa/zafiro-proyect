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
        
        $posts = Post::withCount(['likes', 'comments'])->where('user_id', $user->id)->orderBy('created_at','DESC')->get();
        return view('dashboard.profile.index', compact('posts', 'user'));

    }

    public function edit(){
        
        return view('dashboard.profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(UpdateProfileRequest $request){

        $user = auth()->user();

        $data = $request->safe()->except('image');
        if($request->hasFile('image')){
            if ($user->image !== asset('images/profile.svg')) {
                $relativePath = str_replace('/storage/', '', parse_url($user->image, PHP_URL_PATH));
                Storage::disk('public')->delete($relativePath);
            }
            $data['image'] = Storage::disk('users')->put('/', $request->file('image'));
        }
        
        if($request->remove_image == true && !$request->hasFile('image')){
            $url = $user->image; 
            $relativePath = parse_url($url, PHP_URL_PATH); // EXTRAE UNA RUTA RELATIVA
            $relativePath = str_replace('/storage/', '', $relativePath); // ELIMINA LA PARTE DE STORAGE
            
            $data['image'] = null;
            Storage::disk('public')->delete($relativePath);
        }
        
        $user->fill($data)->save();
        $posts = Post::withCount(['likes', 'comments'])->where('user_id', $user->id)->orderBy('created_at','DESC')->get();
        return view('dashboard.profile.index', compact('posts', 'user'));

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
