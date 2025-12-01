@extends('layout.layout')

@section('content')
<main class="d-flex flex-row w-100">
    <div class="feed mx-auto">
        <h2 class="my-3">Liked posts</h2>
        <div class="container py-3" style="width: 895px;">
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @forelse ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')    
                    </div>
                @empty
                    <p class="text-center">No liked post yet.</p>
                @endforelse               
            </div>
        </div>
    </div>
</main>
@endsection