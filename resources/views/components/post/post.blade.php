<div class="post-card position-relative mb-4 p-2">
    <div class="post-meta-top">
        <div class="author-block">
            <img src="{{ $post->user->image }}" alt="Avatar de {{ $post->user->username }}" class="avatar">
            <div class="d-flex flex-column">
                <a href="{{route('dashboard.profile', $post->user)}}" class="fw-semibold text-decoration-none navigation" data-route="{{ route('dashboard.profile', $post->user) }}">{{ '@' . $post->user->username }}</a>
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
    <div class="position-relative">
        <figure class="mb-3">
            {{-- <img src="{{ $post->image }}" alt="Imagen del post de {{ $post->user->username }}"> --}}
            @if($post->image == "http://127.0.0.1:8000/images/post.svg")
                <img src="{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
            @else
                <img src="/storage/{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
            @endif
        </figure>
        <div class="post-description fw-normal text-break">{{$post->description}}</div>
        @if($clickable)
            <a href="{{ route('dashboard.posts.show', $post) }}" class="position-absolute top-0 w-100 h-100"></a>
        @endif
    </div>
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
                <i class="bi bi-chat-fill btn-comment"></i>
                <span>{{$post->comments()->count()}}</span>
            </div>
        </div>
    </div>
</div>