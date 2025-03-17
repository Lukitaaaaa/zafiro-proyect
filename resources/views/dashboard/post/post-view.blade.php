@extends('layout.layout')

@section('content')
<main class=" w-100 py-5" style="margin-left: 240px!important;">
    <div class="mx-auto d-flex border rounded-4 p-3" style="width: 895px; background-color: black;">
        <img src="/storage/{{$post->image}}" alt="Imagen de un post" class="object-fit-cover" width="285" height="285">
        <div class="ms-3 d-flex flex-column position-relative w-75">
            <div class="mb-3 d-flex gap-3">
                <img 
                    src="{{auth()->user()->image}}" 
                    alt="{{auth()->user()->name}}"
                    width="32" 
                    height="32" 
                    class="object-fit-cover rounded-circle"
                >
                <span class="fs-5">@user</span>
            </div>
            @if ($editing)
                <form action="{{route('dashboard.posts.update', $post)}}" method="POST" class="mb-auto position-relative d-flex">
                    @csrf
                    @method('PUT')
                    <div class="w-75">
                        <x-form.text-area name="description" id="description" rows="5"/>
                    </div>
                    <div class="position-absolute end-0 mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            @else 
                <span class="mb-auto fs-3 w-75 text-break">{{$post->description}}</span>   
                <div class="position-absolute end-0 mt-3">
                    <div class="d-flex flex-column row-gap-3">
                        <a href="{{route('dashboard.profile')}}" class="btn btn-primary">Close</a>
                        @if(auth()->user()->id === $post->user_id)

                            <a href="{{route('dashboard.posts.edit', $post)}}" class="btn btn-warning">Edit</a>
                            <form id="form_{{$post->id}}" action="{{route('dashboard.posts.destroy', $post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div class="d-flex column-gap-4">
                    <div class="likes d-flex  column-gap-2 align-items-center">
                        <i class="bi bi-heart-fill"></i>
                        <p class="m-0">{{$post->likes}}</p>
                    </div>
                    <div class="comments d-flex column-gap-2  align-items-center">
                        <i class="bi bi-chat-fill"></i>
                        <p class="m-0">0</p>
                    </div>
                </div>
                <strong>{{$post->created_at}}</strong>
            </div>
        </div>
    </div>
    <div class="w-full border mt-3 mx-auto" style="width: 895px; background-color: black;">
        <h2 class="text-center">Comments</h2>

        {{-- input-add-comment --}}
        <form action="" method="POST" class="d-flex justify-content-between p-3 border-bottom" >
            @csrf
            <input type="text" class="form-control" placeholder="Write a comment" style="width: 80%;">
            <button class="btn btn-primary">Add comment</button>
        </form>
        {{-- comments --}}
        <article class="d-flex flex-column border-bottom">
            {{-- foreach --}}
            <div class="d-flex justify-content-between align-items-center" style="padding: .5rem 75px">
                <div class="d-block">
                    <img 
                        src="{{auth()->user()->image}}" 
                        alt="{{auth()->user()->name}}"
                        width="32" 
                        height="32" 
                        class="object-fit-cover rounded-circle"
                        style="margin-right: 10px"
                    >
                    <span>@user</span>
                </div>
                <button type="button" class="rounded-circle btn btn-primary">
                    <i class="bi bi-three-dots"></i>
                </button>
                {{-- <i class="bi bi-heart"></i> --}}
            </div>
            <div class="d-flex" style="padding: 0 75px;">
                <div style="width: 44px; height: 10px"></div>
                <p style="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.</p>
            </div>
            
            {{-- @empty($comments)
                <p class="text-center">No comments</p> --}}
        </article>
        
    </div>
</main>
@endsection
