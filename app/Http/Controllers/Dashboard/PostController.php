<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create-post');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        //dd($request->all());
        $request->validate([
            'description'=> 'max:100096',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $request['user_id'] = auth()->id();
        
        $post = Post::create($request->all());
        
        
        if($request->hasFile('image')){
            $name = Str::uuid().'.'.$request->file('image')->getClientOriginalExtension();
            $img = $request->file('image')->storeAs('public/img',$name);
            $post->image = '/img/'.$name;
            $post->save();
        }
        
        //dd($request->all());
        return redirect()->route('dashboard.profile', auth()->user());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
            
        $post->load(['comments' => function ($query) {
            $query->with('user')->orderBy('created_at', 'desc'); // Ordenar los comentarios por fecha de creación (más recientes primero)
        }, 'comments.user', 'user']);

        $editing = false;
        return view('dashboard.post.post-view', compact('post', 'editing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $editing = true;
        return view('dashboard.post.post-view', compact('post', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'description'=>'string|max:255|nullable'
        ]);

        $post->update($request->all());
        $editing = false;
        return view('dashboard.post.post-view', compact('post', 'editing'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);

        $post->delete();
        return redirect()->route('dashboard.profile', auth()->user());
    }
}
