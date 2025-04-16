@extends('layout.layout')

@section('content')
<style>
    .button{
        border: none;
        background: none;
        cursor: pointer;
        width: 75px;
        display: flex;
        justify-content: center;
        align-items: center;    
    }

    .btn-likes{
        border: none;
        background: none;
        padding: 0;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease;    
    }

    .btn-likes:hover{
        background-color: rgba(232, 18, 18, 0.1);
    }

    .button:disabled > span{
        cursor: not-allowed;
        opacity: 0.5;
    }

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
                    <a href="{{route('dashboard.profile', $post->user)}}" class="fs-5"> {{ '@' . $post->user->username }}</a>
                </div>
                <div class="dropdown">
                    <a href="#" class="menu-comments" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    
                        @if(auth()->user()->id === $post->user->id)
                            <a href="{{route('dashboard.posts.edit', $post)}}" class="dropdown-item">Edit</a>
                            <li>
                                <form action="{{route('dashboard.posts.destroy', $post)}}" method="post" class="m-0">
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
                <span class="mb-auto fs-3 w-100 text-break">{{$post->description}}</span>   
            @endif
            <div class="d-flex justify-content-between">
                <div class="d-flex column-gap-4">
                    <div class="likes d-flex align-items-center">
                        @if(auth()->user()->isLiked($post))
                            <form action="{{route('dashboard.posts.unlike', $post)}}" method="post" class="m-0">
                                @csrf
                                <button type="submit" class="btn-likes"><i class="bi bi-heart-fill text-danger"></i></button>
                            </form>
                        @else
                            <form action="{{route('dashboard.posts.like', $post)}}" method="post" class="m-0">
                                @csrf
                                <button type="submit" class="btn-likes"><i class="bi bi-heart text-danger"></i></button>
                            </form>
                        @endif
                        <p class="m-0">{{$post->likes()->count()}}</p>
                    </div>
                    <div class="comments d-flex column-gap-2  align-items-center">
                        <i class="bi bi-chat-fill"></i>
                        <p class="m-0">{{$post->comments()->count()}}</p>
                    </div>
                </div>
                <strong>{{$post->created_at->diffForHumans()}}</strong>
            </div>
        </div>
    </div>
    <div class="w-full border mt-3 mx-auto" style="width: 895px; background-color: black;">
        {{-- input-add-comment --}}
        <form action="{{route('dashboard.comments.store', $post->id)}}" method="POST" class="d-flex justify-content-between m-0 border-bottom gap-5" style="padding: 1rem 75px;" >
            @csrf
            <input type="text" name="content" id="content" class="form-control w-100" placeholder="Write a comment...">
            <button id="add-comment-btn" class="button">
                <span id="button-text">Publish</span>
                <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        {{-- comments  --}}
        @forelse($post->comments as $comment)
            
            <article class="d-flex border-bottom" style="padding: .5rem 75px">
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
                            <a href="{{route('dashboard.profile', $comment->user)}}" class="text-primary">{{ '@' . $comment->user->username }}</a>
                        </div>
                        <div class="d-flex align-items-center column-gap-2">
                            <span>{{ $comment->created_at->diffInSeconds() < 60 ? 'Now' : $comment->created_at->diffForHumans() }}</span>
                            <div class="dropdown">
                                <a href="#" class="menu-comments" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    @if(auth()->user()->id === $comment->user_id || auth()->user()->id === $post->user_id)
                                        <li>
                                            <form action="{{route('dashboard.comments.destroy', $comment)}}" method="post" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Remove</button>
                                            </form>
                                        </li>
                                    @endif
                                    @if(auth()->user()->id !== $comment->user_id)
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
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.querySelector('form[action="{{ route('dashboard.comments.store', $post->id) }}"]');
        const button = document.getElementById('add-comment-btn');
        const input = document.getElementById('content');

        button.disabled = input.value.trim() === '';

        input.addEventListener('input', () => {
            button.disabled = input.value.trim() === '';
        });

        form.addEventListener('submit', function () {
            button.disabled = true;
            document.getElementById('button-text').classList.add('d-none'); // Ocultar el texto
            document.getElementById('spinner').classList.remove('d-none'); // Mostrar el spinner
        });
    });
</script>