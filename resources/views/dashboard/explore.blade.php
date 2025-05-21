@extends('layout.layout')

@section('content')
<main class="d-flex flex-row w-100" style="margin-left: 240px;">
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 895px;">
            <div class="mb-4">
                <form action="" method="GET" class="d-flex" role="search">
                    <input 
                        type="text" 
                        name="q" 
                        class="form-control rounded-pill me-2" 
                        placeholder="Search users..." 
                        value="{{ request('q') }}"
                        autocomplete="off"
                    >
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </form>
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