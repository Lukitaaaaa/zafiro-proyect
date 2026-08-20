@extends('layout.layout')

@section('content')

<main class=" w-100 py-3">
    <div class="users-list mx-auto">
        <header class="d-flex align-items-center mb-3">
            <a class="text-white me-3" href="{{ route('dashboard.home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
            <h3 class="mb-0">Suggested for you</h3>
        </header>

        @foreach ($users as $user)
        <article class="d-flex py-2">
            <figure class="m-0 me-3">
                <img class="rounded-circle object-fit-cover"
                    src="{{ $user->image }}" 
                    alt="{{ $user->name }}"
                    width="40"
                    height="40"
                >
            </figure>
            <div class="d-grid gap-1 w-100">
                <header class="d-flex justify-content-between align-items-center ">

                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{route('dashboard.profile', $user)}}">{{ $user->name }}</a>
                        <p class="mb-0 small text-truncate">{{ '@' . $user->username }}</p>
                    </div>
                    <form action="{{ route( 'dashboard.profile.follow', $user)}}" method="post" class="ms-auto">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Follow</button>
                    </form>
                </header>
                <span class="text-break">{{ $user->bio }}</span>
            </div>
        </article>
        @endforeach
    </div>
</main>
@endsection