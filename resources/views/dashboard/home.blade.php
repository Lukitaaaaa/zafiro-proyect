@extends('layout.layout')

@section('content')
{{-- Styles extracted to resources/css/components/follow.css via Vite --}}
<main class="d-flex flex-row w-100">
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 500px;">
            @foreach ($posts as $post)
                <div class="post-card mb-4 p-2">
                    <div class="post-meta-top">
                        <div class="author-block">
                            <img src="{{ $post->user->image }}" alt="Avatar de {{ $post->user->username }}" class="avatar">
                            <div class="d-flex flex-column">
                                <a href="{{route('dashboard.profile', $post->user)}}" class="fw-semibold text-decoration-none">{{ '@' . $post->user->username }}</a>
                                <small class="timestamp">{{$post->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <div class="dropdown" role="menu">
                            <a href="#" class="menu-comments" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
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
                    <article class="mb-3">
                        {{-- <img src="{{ $post->image }}" alt="Imagen del post de {{ $post->user->username }}"> --}}
                        @if($post->image == "http://localhost:8000/images/post.svg")
                            <img src="{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
                        @else
                            <img src="/storage/{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
                        @endif
                    </article>
                    <div class="post-description fw-normal text-break">{{$post->description}}</div>
                    <div class="action-bar" aria-label="Post actions">
                        <div class="actions-group">
                            <div class="action-item" aria-label="Likes">
                                @if(auth()->user()->isLiked($post))
                                    <form action="{{route('dashboard.posts.unlike', $post)}}" method="post" class="m-0" aria-label="Unlike">
                                        @csrf
                                        <button type="submit" class="btn-like-toggle" aria-pressed="true"><i class="bi bi-heart-fill text-danger"></i></button>
                                    </form>
                                @else
                                    <form action="{{route('dashboard.posts.like', $post)}}" method="post" class="m-0" aria-label="Like">
                                        @csrf
                                        <button type="submit" class="btn-like-toggle" aria-pressed="false" onclick="likePost({{ $post->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart text-danger" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <span>{{$post->likes()->count()}}</span>
                            </div>
                            <div class="action-item" aria-label="Comments">
                                <i class="bi bi-chat-fill btn-like-toggle"></i>
                                <span>{{$post->comments()->count()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')    
                    </div>
                @endforeach               
            </div> --}}
        </div>
    </div>
    <div class="how-to-follow-container">
        <div class="follow-shell position-sticky me-3" aria-label="Suggestions to follow" style="top: 1rem;">
            <h5>Who to follow</h5>
            <div class="follow-list">
                @foreach ($users as $user)
                    <div class="follow-item">
                        <div class="avatar">
                            <img src="{{ $user->image }}" alt="{{ $user->name }} avatar">
                        </div>
                        <div class="overflow-hidden" style="min-width:0;">
                            <a class="mb-0 small text-truncate d-block" href="{{route('dashboard.profile', $user)}}">{{ $user->name }}</a>
                            <p class="mb-0 text-truncate" style="max-width:140px;">{{ '@' . $user->username }}</p>
                        </div>
                        <form action="{{ route('dashboard.profile.follow', $user->id)}}" method="post" class="ms-auto" aria-label="Follow {{ $user->username }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                        <a href="{{route('dashboard.profile', $user)}}" class="position-absolute w-100 h-100" onclick="routeTo(event, '{{ route('dashboard.profile', $user) }}')"></a>
                    </div>
                @endforeach
            </div>
            <div class="show-more-wrapper">
                <a href="{{ route('dashboard.show-users') }}" onclick="routeTo(event, '{{ route('dashboard.show-users') }}')" aria-label="Show more user suggestions">Show More</a>
            </div>
        </div>
    </div>
</main>
    
@endsection
