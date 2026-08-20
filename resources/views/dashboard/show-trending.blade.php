@extends('layout.layout')

@section('content')

    <main class=" w-100 py-3">
        <div class="users-list mx-auto">
            <header class="d-flex align-items-center mb-3">
                <a class="text-white me-3" href="{{ route('dashboard.home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                </a>
                <h3 class="mb-0">Trending topics</h3>
            </header>

            @foreach ($trendingTags as $index => $trendingTag)
                <div class="d-flex justify-content-between align-items-center ">
                    <div class="">
                        <span class="fs-2">{{ $index + 1 }}</span>
                        <span class="fs-3">#{{ $trendingTag->name }}</span>
                    </div>
                    <span class="text-muted">{{ number_format($trendingTag->posts_count) }} Posts</span>
                </div>
            @endforeach
        </div>
    </main>
@endsection