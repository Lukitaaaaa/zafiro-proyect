@extends('layout.layout')

@section('content')

<style>
    .avatar {
        width: 40px;
        height: 40px;
    }
    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .how-to-follow-container {
        max-width: 290px;
        
    }
</style>
<main class="d-flex flex-row w-100" style="margin-left: 240px;">
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 895px;">
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')    
                    </div>
                @endforeach               
            </div>
        </div>
    </div>
    <div class="how-to-follow-container pt-3">
        <div class="card me-3">
            <div class=" pb-0 border-0">
                <h5 class="m-3">Who to follow</h5>
            </div>
            <div class="px-2">
                @foreach ($users as $user)
                    <div class="hstack gap-2 mb-3">
                        <div class="avatar">
                            <a href="{{route('dashboard.profile', $user)}}">
                                <img class="avatar-img rounded-circle"
                                src="{{ $user->image }}" 
                                alt="{{ $user->name }}"
                                >
                            </a>
                        </div>
                        <div class="overflow-hidden">
                            <a class="mb-0 small" href="{{route('dashboard.profile', $user)}}">{{ $user->name }}</a>
                            <p class="mb-0 small text-truncate">{{ '@' . $user->username }}</p>
                        </div>
                        <form action="{{ route( 'dashboard.profile.follow', $user->id)}}" method="post" class=" ms-auto">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Follow</button>
                        </form>
                    </div>
                @endforeach
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="{{ route('dashboard.show-users') }}">Show More</a>
                </div>
            </div>
        </div>
        
    </div>
</main>
    
@endsection
