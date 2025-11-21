@extends('layout.layout')

@section('content')
{{-- Styles extracted to resources/css/components/follow.css via Vite --}}
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
        <div class="follow-shell me-3" aria-label="Suggestions to follow">
            <h5>Who to follow</h5>
            <div class="follow-list">
                @foreach ($users as $user)
                    <div class="follow-item">
                        <div class="avatar">
                            <img src="{{ $user->image }}" alt="{{ $user->name }} avatar">
                        </div>
                        <div class="overflow-hidden flex-grow-1" style="min-width:0;">
                            <a class="mb-0 small text-truncate d-block" href="{{route('dashboard.profile', $user)}}">{{ $user->name }}</a>
                            <p class="mb-0 text-truncate" style="max-width:140px;">{{ '@' . $user->username }}</p>
                        </div>
                        <form action="{{ route('dashboard.profile.follow', $user->id)}}" method="post" class="ms-auto" aria-label="Follow {{ $user->username }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                        <a href="{{route('dashboard.profile', $user)}}" class="position-absolute w-100 h-100"></a>
                    </div>
                @endforeach
            </div>
            <div class="show-more-wrapper">
                <a href="{{ route('dashboard.show-users') }}" aria-label="Show more user suggestions">Show More</a>
            </div>
        </div>
    </div>
</main>
    
@endsection
