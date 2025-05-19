<article class="d-flex " style="padding: 0">
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
        <p class="text-break mb-2">{{$comment->content}}</p>
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
            @if(!$comment->isReply())
                <div class="reply d-flex column-gap-2 align-items-center">
                    <i class="bi bi-chat-fill"></i>
                    <span>Reply</span>
                </div>
            @endif
        </div>
        @if(!$comment->isReply())
            <form action="{{ route('dashboard.comments.reply', $comment)}}" method="POST" class="form d-none d-flex align-items-center justify-content-between m-0" style="padding: 1rem 0px;" >
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
                <input type="text" name="content" id="content-reply" class="form-control w-100 rounded-pill" placeholder="Write a reply...">
                <button id="add-reply-btn" class="button ms-3 rounded-pill">
                    <span id="button-text">Publish</span>
                    <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </form>
            {{-- replies --}}
            @if($comment->replies->count() > 0)
                <button type="button" class="show-replies button py-1" data-comment-id="{{ $comment->id }}" style="width: 120px; text-align: left; display:block">
                    <span class="text-muted d-none">Hide replies</span>
                    <span class="text-muted" >{{ 'View replies (' . $comment->replies->count() .')' }}</span>
                </button>
            @endif
            
            <ol class="replies d-none position-relative border-start border-4" data-comment-id="{{ $comment->id }}" style="list-style: none; margin:10px 0 0 10px; padding-left: 15px;">
                @forelse($comment->replies as $reply)
                    <li>
                        <x-comment :comment="$reply" :post="$post" />
                    </li>
                @empty
                @endforelse
            </ol>
        @endif
    </div>
</article>