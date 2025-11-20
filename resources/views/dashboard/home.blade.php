@extends('layout.layout')

@section('content')
@once
<style>
    
    :root {
        --surface-primary: #111;
        --surface-secondary: #181818;
        --surface-elevated: #202020;
        --border-color: #2a2a2a;
        --radius-lg: 1.25rem;
        --radius-md: .75rem;
        --transition-fast: .18s ease;
    }
    
    .avatar { width:40px !important; height:40px !important; }
    .avatar img { height:100%; object-fit:cover; border-radius:50%; border:1px solid var(--border-color); }
    .how-to-follow-container { max-width:290px; }
    .follow-shell { background:linear-gradient(145deg,var(--surface-primary),var(--surface-secondary)); border:1px solid var(--border-color); border-radius:var(--radius-lg); padding:.9rem .9rem .75rem; box-shadow:0 4px 14px -4px rgba(0,0,0,.35); }
    .follow-shell h5 { font-size:.95rem; font-weight:600; letter-spacing:.5px; margin:0 0 .75rem; }
    .follow-list { display:flex; flex-direction:column; gap:.6rem; }
    .follow-item { display:flex; align-items:center; gap:.6rem; padding:.45rem .55rem; border-radius:.65rem; transition:var(--transition-fast); position: relative;}
    .follow-item:hover { background:rgba(255,255,255,.06); }
    .follow-item a.mb-0 { font-weight:500; text-decoration:none; }
    .follow-item p { font-size:.7rem; color:#999; }
    .follow-item form button { padding:.35rem .8rem; font-size:.7rem; font-weight:600; }
    .show-more-wrapper { margin-top:.75rem; }
    .show-more-wrapper a { font-size:.7rem; background:var(--surface-elevated); border:1px solid var(--border-color); color:#0d6efd; border-radius:var(--radius-md); padding:.45rem .75rem; text-decoration:none; display:inline-block; transition:var(--transition-fast); }
    .show-more-wrapper a:hover { background:#262626; color:#4da3ff; }
</style>
@endonce
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
