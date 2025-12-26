<article 
    id="post" 
    class="post-card position-relative mb-4 p-2" 
    data-post-id="{{ $post->id }}" 
    x-data="{ description: '{{ addslashes($post->description) }}' }"
    @post-updated.window="
        if ($event.detail[0].postId === {{ $post->id }}) {
            description = $event.detail[0].description;
        }
    "
    >
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
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" x-data>
                @if(auth()->user()->id === $post->user->id)
                    {{-- <a href="{{route('dashboard.posts.edit', $post)}}" class="dropdown-item">Edit</a> --}}
                    <li>
                        <button 
                            @click="$dispatch('open-edit-post-modal', { post: {{ $post }} })"
                            class="dropdown-item">
                            Edit
                        </button>
                    </li>
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
        <div id="postDescription{{ $post->id }}" class="post-description fw-normal text-break" x-text="description"></div>
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
                        <button type="submit" class="btn-like-toggle" aria-pressed="true" data-post-id="{{ $post->id }}"><i class="bi bi-heart-fill text-danger"></i></button>
                    </form>
                @else
                    <form action="{{route('dashboard.posts.like', $post)}}" method="post" class="m-0" aria-label="Like">
                        @csrf
                        <button type="submit" class="btn-like-toggle" aria-pressed="false" data-post-id="{{ $post->id }}">
                            <i class="bi bi-heart text-danger"></i>
                        </button>
                    </form>
                @endif
                <span id="likesCounter" data-post-id="{{ $post->id }}">{{$post->likes()->count()}}</span>
            </div>
            <div class="action-item" aria-label="Comments">
                <i class="bi bi-chat-fill btn-comment"></i>
                <span id="commentsCounter" data-post-id-comments="{{ $post->id }}">{{$post->comments()->count()}}</span>
            </div>
        </div>
    </div>
</article>