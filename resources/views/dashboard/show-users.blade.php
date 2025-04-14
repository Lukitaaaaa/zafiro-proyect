@extends('layout.layout')

@section('content')
<style>
    .users-list {
        max-width: 560px;
    }
</style>

<div class=" w-100 py-3" style="margin-left: 240px;">
    <div class="users-list mx-auto">
        <header class="d-flex align-items-center mb-3">
            <a class="btn btn-primary-soft rounded-circle icon-lg fs-3" href="{{ route('dashboard.home') }}"><i class="bi bi-arrow-left"></i></a>
            <h3>Suggested for you</h3>
        </header>

        @foreach ($users as $user)
        <article class="d-flex py-2">
            <figure class="m-0 me-3">
                <img class="avatar-img rounded-circle object-fit-cover"
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
                    <button class="ms-auto btn btn-primary">Follow</button>
                </header>
                <span class="text-break">{{ $user->bio }}</span>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection