<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('create-post');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'description'=> 'max:6096',
            'image'=> 'required|image',
        ]);
        $post = Post::create($request->all());

        if($request->hasFile('image')){
            $name = $post->id.'.'.$request->file('image')->getClientOriginalExtension();
            $img = $request->file('image')->storeAs('public/img',$name);
            $post->image = '/img/'.$name;
            $post->save();
        }

        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $editing = false;
        return view('post-view', compact('post', 'editing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $editing = true;
        return view('post-view', compact('post', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'description'=>'string|max:1040|nullable'
        ]);

        $post->update($request->all());
        $editing = false;
        return view('post-view', compact('post', 'editing'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect()->route('profile');
    }
}
