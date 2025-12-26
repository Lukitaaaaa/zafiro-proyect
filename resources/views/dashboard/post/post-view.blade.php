@extends('layout.layout')

@section('content')

<main class="d-flex w-100 py-3">
    <section class="post-view">
        <header class="d-flex align-items-center mb-3">
            <a class="text-white me-3" href="{{ route('dashboard.home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
            <h3 class="mb-0">Post</h3>
        </header>
        <x-post.post :post="$post" :clickable="false"/>
    @if(!$editing)    
        <section class="comments-wrapper" aria-label="Comments section">
            {{-- input-add-comment --}}
            <form id="commentForm" class="comment-input-row m-0" aria-label="Agregar comentario">
                @csrf
                <img src="{{ auth()->user()->image }}" alt="Tu avatar" class="avatar-small">
                <input type="text" name="content" id="content" class="form-control w-100 rounded-pill" placeholder="Write a comment..." aria-label="Comment content" required>
                <button type="submit" id="addCommentBtn" data-post-id="{{ $post->id }}" class="publish-btn">
                    <span id="button-text">Publish</span>
                    <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </form>
            {{-- comments  --}}
            <div class="comments-box">
                @forelse($post->comments as $comment) 
                    <x-comment :comment="$comment" :post="$post" />
                @empty
                    <div id="noCommentsMessage" class="{{ $post->comments->count() > 0 ? 'd-none' : '' }} text-center py-3">
                        <span class="text-muted">No comments yet. Be the first to comment!</span>
                    </div>
                @endforelse
            </div>
        </section>
    </section>

    <x-suggested-users :users="$users"/>
    @else
    </section>
    @endif
    @livewire('edit-post-modal', ['post' => $post])
</main>
@endsection
