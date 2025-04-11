@extends('layout.layout')

@section('content')
<style>
    .menu-comments{
        border: none;
        background: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        text-align: center;
        height: 32px;
        width: 32px;
        padding: 10px;
        border-radius: 50%; 
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }
 
    .menu-comments:hover{
        background-color: rgb(140, 140, 140, 0.1);
    }
</style>

<main class=" w-100 py-5" style="margin-left: 240px!important;">
    <div class="mx-auto d-flex border rounded-4 p-3" style="width: 895px; background-color: black;">
        <img src="/storage/{{$post->image}}" alt="Imagen de un post" class="object-fit-cover" width="285" height="285">
        <div class="ms-3 d-flex flex-column position-relative w-75">
            <div class="mb-3 d-flex justify-content-between">
                <div class="d-flex gap-3">

                    <img 
                        src="{{ $post->user->image }}" 
                        alt="{{ $post->user->name }}"
                        width="32" 
                        height="32" 
                        class="object-fit-cover rounded-circle"
                    >
                    <span class="fs-5"> {{ '@' . $post->user->username }}</span>
                </div>
                <div class="dropdown">
                    <a href="#" class="menu-comments" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    
                        @if(auth()->user()->id === $post->user->id)
                            <a href="{{route('dashboard.posts.edit', $post)}}" class="dropdown-item">Edit</a>
                            <li>
                                <form action="{{route('dashboard.posts.destroy', $post)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">Remove</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="#">Report</a></li>
                        @endif
                    </ul>
                </div>
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
                {{-- <div class="position-absolute end-0 mt-3">
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
                </div> --}}
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
        {{-- input-add-comment --}}
        <form action="{{route('dashboard.comments.store', $post->id)}}" method="POST" class="d-flex justify-content-between p-3 border-bottom" >
            @csrf
            <input type="text" name="content" id="content" class="form-control" placeholder="Write a comment" style="width: 80%;">
            <button class="btn btn-primary">Add comment</button>
        </form>
        {{-- comments  --}}
        @forelse($post->comments as $comment)
            
            <article class="d-flex border-bottom overflow-hidden" style="padding: .5rem 75px">
                <div class="me-3">
                    <img 
                        src="{{ $comment->user->image }}" 
                        alt="{{ $comment->user->name }}"
                        width="32" 
                        height="32" 
                        class="object-fit-cover rounded-circle"
                    >
                </div>
                <div class="d-grid w-100"> 
                    <header class="d-flex justify-content-between align-items-center" style="height: 32px;">
                        <div class="d-block">
                            <span class="text-primary">{{ '@' . $comment->user->username }}</span>
                        </div>
                        <div class="d-flex align-items-center column-gap-2">
                            <span>2 horas</span>
                            {{-- TODO:menu a arreglar --}}
                            <div class="dropdown">
                                <a href="#" class="menu-comments" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    @if(auth()->user()->id === $comment->user_id)
                                        <li>
                                            <form action="{{route('dashboard.comments.destroy', $comment)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Remove</button>
                                            </form>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item" href="#">Report</a></li>
                                    @endif
                                </ul>
                            </div>
                            
                        </div>
                    </header>
                    <p class="text-break">{{$comment->content}}</p>
                    <div class="d-flex gap-4">
                        <div class="likes d-flex column-gap-2 align-items-center">
                            <i class="bi bi-heart-fill"></i>
                            <span>0</span>
                        </div>
                        <div class="answers d-flex column-gap-2 align-items-center">
                            <i class="bi bi-chat-fill"></i>
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="text-center py-3">
                <span class="text-muted">No comments yet. Be the first to comment!</span>
            </div>
        @endforelse
        
    </div>
</main>

@endsection
