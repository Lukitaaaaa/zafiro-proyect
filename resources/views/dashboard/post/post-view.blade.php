@extends('layout.layout')

@section('content')
@once
<style>
    /* Design refresh: minimal dark, soft surfaces, consistent spacing */
    :root {
        --surface-primary: #111;
        --surface-secondary: #181818;
        --surface-elevated: #202020;
        --border-color: #2a2a2a;
        --radius-lg: 1.25rem;
        --radius-md: .75rem;
        --transition-fast: .18s ease;
    }

    .post-shell {
        width: 895px;
        background: linear-gradient(145deg, var(--surface-primary), var(--surface-secondary));
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        margin: 0 auto;
        display: flex;
        gap: 1.25rem;
        position: relative;
        box-shadow: 0 4px 16px -4px rgba(0,0,0,.35);
    }

    .post-image-wrapper img { /* keep deterministic sizing */
        border-radius: var(--radius-md);
        object-fit: cover;
        aspect-ratio: 1 / 1;
    }

    .post-meta-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: .75rem;
    }

    .author-block {
        display: flex;
        gap: .85rem;
        align-items: center;
    }
    .author-block .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--surface-elevated);
    }

    .post-description {
        font-size: 1.05rem;
        line-height: 1.4;
        margin-bottom: 1.25rem;
        white-space: pre-line;
    }

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: .5rem;
        border-top: 1px solid var(--border-color);
        gap: .75rem;
    }
    .actions-group {
        display: flex;
        gap: 1.25rem;
        align-items: center;
    }
    .action-item {
        display: flex;
        align-items: center;
        gap: .45rem;
        font-size: .95rem;
        color: #ddd;
    }
    .btn-like-toggle {
        border: none;
        background: none;
        padding: 0;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition-fast);
        cursor: pointer;
    }
    .btn-like-toggle:hover { background: rgba(220,20,60,.12); }

    .menu-comments {
        border: none;
        background: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        text-align: center;
        height: 36px;
        width: 36px;
        border-radius: 50%;
        color: #fff;
        transition: var(--transition-fast);
    }
    .menu-comments:hover { background: rgba(255,255,255,.06); }

    .comments-wrapper {
        width: 620px;
        margin: 1.75rem auto 0;
        background: var(--surface-primary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .comment-input-row {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: 1rem 3.5rem;
        border-bottom: 1px solid var(--border-color);
        background: var(--surface-secondary);
    }
    .comment-input-row .avatar-small {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }
    .comment-input-row input.form-control {
        background: var(--surface-elevated);
        border: 1px solid var(--border-color);
        color: #eee;
    }
    .comment-input-row input.form-control:focus {
        background: var(--surface-elevated);
        color: #fff;
        box-shadow: 0 0 0 2px rgba(13,110,253,.25);
    }
    .publish-btn {
        border: none;
        background: none;
        cursor: pointer;
        width: 84px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        font-weight: 600;
        color: #0d6efd;
        transition: var(--transition-fast);
    }
    .publish-btn:hover { color: #4da3ff; }
    .publish-btn:disabled { opacity:.4; cursor: not-allowed; }

    .comments-box {
        margin: 0 3.5rem;
        padding: 1.15rem 0 1.4rem;
        display: grid;
        gap: .85rem;
    }
    .comments-box .comment-item { /* potential hook for x-comment component */
        background: var(--surface-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: .85rem .95rem;
        display: flex;
        flex-direction: column;
        gap: .5rem;
        transition: var(--transition-fast);
    }
    .comments-box .comment-item:hover { border-color: #333; }

    /* Utility to soften headings */
    .timestamp { font-size: .75rem; letter-spacing: .5px; color: #999; }
</style>
@endonce
<main class="w-100 py-5" style="margin-left: 240px!important;">
    <article class="post-shell" role="article" aria-label="Post detail">
        {{-- PARA QUE SE VEAN LAS IMAGENES DE LOS POSTS CREADOS POR EL FACTORY Y EL USUARIO --}}
        {{-- CUANDO NO SE NECESITE LOS POST GENERADOS POR EL FACTORY, SE PUEDE ELIMINAR EL IF --}}
        <div class="post-image-wrapper">
            @if($post->image == "http://localhost:8000/images/post.svg")
                <img src="{{$post->image}}" alt="Post image" width="285" height="285" style="min-width:285px;">
            @else
                <img src="/storage/{{$post->image}}" alt="Post image" width="285" height="285" style="min-width:285px;">
            @endif
        </div>
        <div class="flex-grow-1 d-flex flex-column" role="group" aria-label="Post main content">
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
            @if ($editing)
                <form action="{{route('dashboard.posts.update', $post)}}" method="POST" class="position-relative mb-3" aria-label="Editar descripción">
                    @csrf
                    @method('PUT')
                    <x-form.text-area name="description" id="description" rows="5"/>
                    <div class="mt-2 text-end">
                        <button type="button" onclick="window.location='{{ route('dashboard.posts.show', $post) }}'" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary px-4">Update</button>
                    </div>
                </form>
            @else
                <div class="post-description fw-normal text-break">{{$post->description}}</div>
            @endif
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
                                <button type="submit" class="btn-like-toggle" aria-pressed="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart text-danger" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                        <span>{{$post->likes()->count()}}</span>
                    </div>
                    <div class="action-item" aria-label="Comments">
                        <i class="bi bi-chat-fill"></i>
                        <span>{{$post->comments()->count()}}</span>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <section class="comments-wrapper" aria-label="Comments section">
        {{-- input-add-comment --}}
        <form action="{{route('dashboard.comments.store', $post->id)}}" method="POST" class="comment-input-row m-0" aria-label="Agregar comentario">
            @csrf
            <img src="{{ auth()->user()->image }}" alt="Tu avatar" class="avatar-small">
            <input type="text" name="content" id="content" class="form-control w-100 rounded-pill" placeholder="Write a comment..." aria-label="Comment content">
            <button id="add-comment-btn" class="publish-btn">
                <span id="button-text">Publish</span>
                <span id="spinner" class="spinner-border text-primary spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        {{-- comments  --}}
        <div class="comments-box">
            @forelse($post->comments as $comment) 
                <x-comment :comment="$comment" :post="$post" />
            @empty
                <div class="text-center py-3">
                    <span class="text-muted">No comments yet. Be the first to comment!</span>
                </div>
            @endforelse
        </div>
    </section>
</main>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {

        //HABILITAR EL BOTON DE RESPONDER CUANDO SE ESCRIBE EN EL INPUT
        //DESABILITARLO CUANDO NO HAY NADA EN EL INPUT O SE ENVIAN LOS DATOS

        const form = document.querySelector('form[action="{{ route('dashboard.comments.store', $post->id) }}"]');
        const button = document.getElementById('add-comment-btn');
        const input = document.getElementById('content');

        button.disabled = input.value.trim() === '';

        input.addEventListener('input', () => {
            button.disabled = input.value.trim() === '';
        });

        form.addEventListener('submit', function () {
            button.disabled = true;
            document.getElementById('button-text').classList.add('d-none'); // Ocultar el texto del boton
            document.getElementById('spinner').classList.remove('d-none'); // Mostrar el spinner
        });

        //MOSTRAR Y OCULTAR EL FORMULARIO DE RESPUESTA

        const toggleForm = document.querySelectorAll('.reply');
        const formReply = document.querySelectorAll('.form');
        const showReplies = document.querySelectorAll('.show-replies');
        const replies = document.querySelectorAll('.replies');

        toggleForm.forEach((reply, index) => { 
            reply.addEventListener('click', function() {
                formReply[index].classList.toggle('d-none');
            });
        });

        //HABILITAR LOS BOTONES DE RESPONDER CUANDO SE ESCRIBE EN EL INPUT CORRESPONDIENTE
        //DESABILITARLOS CUANDO NO HAY NADA EN EL INPUT O SE ENVIAN LOS DATOS

        const addReplyBtn = document.querySelectorAll('#add-reply-btn');
        const inputReply = document.querySelectorAll('#content-reply');
        
        addReplyBtn.forEach((btn, index) => {
            btn.disabled = inputReply[index].value.trim() === '';
        });

        inputReply.forEach((input, index) => {
            input.addEventListener('input', () => {
                addReplyBtn[index].disabled = input.value.trim() === '';
            });
        });

        formReply.forEach((form, index) => {
            form.addEventListener('submit', function () {
                addReplyBtn[index].disabled = true;
                const buttonText = form.querySelector('#button-text');
                const spinner = form.querySelector('#spinner');
                buttonText.classList.add('d-none'); // Ocultar el texto del boton
                spinner.classList.remove('d-none'); // Mostrar el spinner
            });
        });

        //MOSTRAR Y OCULTAR LAS RESPUESTAS

        showReplies.forEach(show => { // Agregar el evento click a cada botón que tenga la clase show-replies
            show.addEventListener('click', function() {
                const commentId = show.getAttribute('data-comment-id');
                const repliesList = document.querySelector(`.replies[data-comment-id="${commentId}"]`);
                if(repliesList){
                    repliesList.classList.toggle('d-none');
                    const spans = show.querySelectorAll('span');
                    spans.forEach(span => span.classList.toggle('d-none'));
                }
            });
        })

        // const addReplyBtn = document.querySelectorAll('#add-reply-btn');
        // const formReplys = document.querySelectorAll('.form-reply');
    });
</script>