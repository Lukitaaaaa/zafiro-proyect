@extends('layout.layout')

@section('content')

    <main class="d-flex flex-row w-100 py-3">
        <section class="explore mx-auto">

            <div class="container" style="width: 895px;">
                <div class="mb-4 position-relative">
                    <form id="formSearch" method="GET" class="form-search d-flex" role="search" style="padding: .5rem;">
                        @csrf
                        {{-- <select name="type" id="type" class="bg-light text-dark rounded-2" style="border: none;">
                            <option value="users" selected>Users</option>
                            <option value="posts">Tendency</option>
                        </select>
                        --}}
                        <div class="d-flex flex-grow-1 border-end rounded-0 me-2">
                            <input type="text" name="q" id="search" class="form-control"
                                style="border: none; background: none;" placeholder="Search users..." {{--
                                value="{{ request('q') }}" --}} autocomplete="off">
                            <button id="clearSearch" class="d-none" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                </svg>
                            </button>
                        </div>
                        <button class="btn" type="submit" id="btnSearch">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </form>
                    <div id="results" class="mt-3 z-3 position-absolute bg-body border rounded shadow"
                        style="display:none; width: 100%; max-height: 450px; overflow-y: auto;">

                    </div>
                </div>
                <div class="users-results mb-4">
                    <div id="users-list" class="row row-cols-4 align-items-center row-gap-4">

                    </div>
                </div>
                @isset($tag)
                    <div class="col-12 p-0 mb-2 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">Posts with <span class="text-primary">#{{ $tag->name }}</span></h5>
                        <a href="{{ route('dashboard.explore') }}" class="btn btn-sm btn-outline-secondary rounded-pill">✕ Clear
                            filter</a>
                    </div>
                @endisset
                <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                    @foreach ($posts as $post)
                        <div class="columna col">
                            @include('components.post-card')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="explore-tendency gap-2">
            <div class="d-grid gap-2 position-sticky" style="top: 1rem;">
                <x-suggested-users :users="$users" />
                <div class="trend me-3">
                    <h5 class="mb-2 fw-semibold">Trending Topics</h5>
                    <ul class="list-tags p-0">
                        @forelse($trendingTags as $index => $trendingTag)
                            <li class="tendency-item">
                                <div class="tendency-number fs-2">{{ $index + 1 }}</div>
                                <div class="list-group-item">
                                    <a href="{{ route('dashboard.explore.tag', $trendingTag) }}"
                                        class="tendency-description text-decoration-none">
                                        <span class="user-select-none hash-icon">#</span>
                                        <span>{{ $trendingTag->name }}</span>
                                    </a>
                                    <span class="text-muted">{{ number_format($trendingTag->posts_count) }} Posts</span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-muted py-3">No trending topics today</li>
                        @endforelse
                    </ul>
                    <div class="show-more-wrapper">
                        <a href="{{ route('dashboard.show-trending') }}" aria-label="Show more tendencies">Show More</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection