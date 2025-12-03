@extends('layout.layout')

@section('content')

<main class="d-flex flex-row w-100">
    
    <div class="mx-auto">
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
                    <button class="btn btn-primary rounded-pill" type="button" id="btnSearch">Search</button>
                </form>
                <div id="results" class="mt-3 z-3 position-absolute bg-body border rounded shadow" style="display:none; width: 100%; max-height: 450px; overflow-y: auto;">

                </div>
            </div>
            <div class="users-results mb-4" >
                <div id="users-list" class="d-flex gap-2">
                    
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
@endsection
