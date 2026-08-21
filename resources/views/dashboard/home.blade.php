@extends('layout.layout')

@section('content')
{{-- Styles extracted to resources/css/components/follow.css via Vite --}}
<main class="d-flex py-3 w-100">
    <section class="feed" data-infinite-scroll-container data-has-more="{{ $posts->hasMorePages() ? 'true' : 'false' }}">
        @forelse ($posts as $post)
            <x-post.post :post="$post" :clickable="true"/>
        @empty
            <div class="empty-feed-state text-center py-5">
                <div class="empty-feed-icon mb-4">
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <!-- Post cards vacíos -->
                        <rect x="25" y="30" width="70" height="15" rx="3" stroke="currentColor" stroke-width="2" fill="none" opacity="0.3"/>
                        <rect x="25" y="55" width="70" height="15" rx="3" stroke="currentColor" stroke-width="2" fill="none" opacity="0.2"/>
                        <rect x="25" y="80" width="70" height="15" rx="3" stroke="currentColor" stroke-width="2" fill="none" opacity="0.1"/>
                        
                        <!-- Icono de búsqueda en el centro -->
                        <circle cx="60" cy="60" r="20" stroke="currentColor" stroke-width="2.5" fill="none" opacity="0.4"/>
                        <line x1="75" y1="75" x2="85" y2="85" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" opacity="0.4"/>
                    </svg>
                </div>
                <h3 class="mb-3 fw-semibold">Your feed is empty</h3>
                <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                    Start following people to see their posts here. Discover creators and connect with the community.
                </p>
                <a href="{{ route('dashboard.explore') }}" class="btn btn-primary px-4">
                    <i class="bi bi-search me-2"></i>Explore Users
                </a>
            </div>
        @endforelse
    </section>
    <x-suggested-users :users="$users"/>
</main>
    
@endsection
