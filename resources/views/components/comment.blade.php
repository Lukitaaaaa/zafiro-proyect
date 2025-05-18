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
                @if(auth()->user()->isLikedComment($comment))
                    <form action="{{ route('dashboard.comments.unlike', [$post, $comment]) }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn-likes"><i class="bi bi-heart-fill text-danger"></i></button>
                    </form>
                @else
                    <form action="{{ route('dashboard.comments.like', [$post, $comment]) }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn-likes"><i class="bi bi-heart text-danger"></i></button>
                    </form>
                @endif
                <span>{{ $comment->likes()->count() }}</span>
            </div>
            <div id="reply" class="answers d-flex column-gap-2 align-items-center">
                <i class="bi bi-chat-fill"></i>
                <span>Reply</span>
            </div>
        </div>
        <form action="" method="POST" id="form" class="d-none d-flex align-items-center justify-content-between m-0" style="padding: 1rem 0px;" >
            @csrf
            <div class="me-3">
                <img 
                    src="{{ auth()->user()->image }}" 
                    alt="{{ auth()->user()->name }}"
                    width="32" 
                    height="32" 
                    class="object-fit-cover rounded-circle"
                >
            </div>
            <input type="text" name="content" id="content" class="form-control w-100" placeholder="Write a comment...">
            <button id="add-comment-btn" class="button ms-3">
                <span id="button-text">Publish</span>
                <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        {{-- replies --}}
        {{-- <div class="py-1">
            <span class="text-muted">View replies (1)</span>
        </div> --}}
    </div>
</article>
<script>
    const replyForm = document.getElementById('reply');
    const form = document.getElementById('form');
    
    replyForm.addEventListener('click', function() {
        form.classList.toggle('d-none');
    });


</script>