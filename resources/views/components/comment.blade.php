<article class="d-flex comment" data-comment-id="{{ $comment->id }}" data-parent-id="{{ $comment->parent_id ?? '' }}" role="article" aria-label="Comment by {{ $comment->user->username }}">
    <div class="me-3 pb-2">
        <img 
            src="{{ $comment->user->image }}" 
            alt="{{ $comment->user->name }}"
            width="32" 
            height="32" 
            class="avatar"
        >

        <div class="line mx-auto {{ $comment->replies->count() > 0 && !$comment->isReply() ? '' : 'd-none' }}"></div>
    </div>
    <div class="d-grid w-100"> 
        <header class="d-flex justify-content-between align-items-center" style="height: 32px;">
            <div class="d-block">
                <a href="{{route('dashboard.profile', $comment->user)}}" class="text-primary">{{ '@' . $comment->user->username }}</a>
            </div>
            <div class="d-flex align-items-center column-gap-2">
                <span>{{ $comment->created_at->diffInSeconds() < 60 ? 'Now' : $comment->created_at->diffForHumans() }}</span>
                <div class="dropdown">
                    <a href="#" class="menu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        @if(auth()->user()->id === $comment->user_id || auth()->user()->id === $post->user_id)
                            <li>
                                <form id="deleteForm{{ $comment->id }}" class="m-0">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <button type="submit" class="dropdown-item text-danger btn-delete-comment" data-comment-id="{{ $comment->id }}">Remove</button>
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
                    <button type="submit" class="btn-like-toggle--comment" data-post-id="{{ $post->id }}" data-comment-id="{{ $comment->id }}" aria-pressed="true"><i class="bi bi-heart-fill text-danger"></i></button>
                    </form>
                @else
                    <form action="{{ route('dashboard.comments.like', [$post, $comment]) }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn-like-toggle--comment" data-post-id="{{ $post->id }}" data-comment-id="{{ $comment->id }}" aria-pressed="false"><i class="bi bi-heart text-danger"></i></button>
                    </form>
                @endif
                <span data-comment-id="{{ $comment->id }}">{{ $comment->likes()->count() }}</span>
            </div>
            @if(!$comment->isReply())
                <button type="button" class="reply d-flex column-gap-2 align-items-center" data-comment-id="{{ $comment->id }}">
                    <i class="bi bi-chat-fill"></i>
                    <span>Reply</span>
                </button>
            @endif
        </div>
        @if(!$comment->isReply())
            <form class="form d-none d-flex align-items-center justify-content-between m-0" style="padding: 1rem 0px;" data-comment-id="{{ $comment->id }}" aria-label="Reply form">
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
                <button type="submit" id="add-reply-btn" class="publish-btn ms-3 rounded-pill" data-comment-id="{{ $comment->id }}">
                    <span id="button-text">Publish</span>
                    <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </form>
            
            <button type="button" class="show-replies publish-btn py-1 {{ $comment->replies->count() > 0 ? '' : 'd-none' }}" data-comment-id="{{ $comment->id }}" aria-expanded="false">
                <span class="text-muted d-none">Hide replies</span>
                <span class="text-muted" > View replies (<span id="repliesCounter">{{  $comment->replies->count() }}</span>)</span>
            </button>
            
            
            {{-- replies --}}
            <div class="replies d-none position-relative" data-comment-id="{{ $comment->id }}">       
                @foreach($comment->replies as $reply)
                    
                    <x-comment :comment="$reply" :post="$post" />
                     
                @endforeach
            </div>
        @endif
    </div>
</article>