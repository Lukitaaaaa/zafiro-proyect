@extends('layout.layout')

@section('content')
<style>
    .hover-secondary:hover {
        background-color: var(--bs-secondary); /* Usa la variable de Bootstrap para el color secundario */
        color: white; /* Cambia el texto a blanco para mejor contraste */
        cursor: pointer; /* Cambia el cursor a pointer para indicar que es interactivo */
    }
</style>
<main class="d-flex flex-row w-100">
    
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 895px;">
            <div class="mb-4 position-relative">
                <form action="" method="GET" class="d-flex" role="search">
                    <input
                        type="text"
                        name="q"
                        id="search"
                        class="form-control rounded-pill me-2"
                        placeholder="Search users..."
                        value="{{ request('q') }}"
                        autocomplete="off"
                    >
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </form>
                <div id="results" class="mt-3 z-3 position-absolute bg-body border rounded shadow" style="display:none; width: 100%; max-height: 450px; overflow-y: auto;">
                    {{-- @if(request('q'))
                        @foreach($users as $user)
                            <div class="user-result p-2 border-bottom">
                                <a href="{{ route('profile.show', $user->username) }}" class="text-decoration-none text-dark">
                                    {{ $user->username }}
                                </a>
                            </div>
                        @endforeach --}}
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@vite('resources/js/explore.js')
@endsection
