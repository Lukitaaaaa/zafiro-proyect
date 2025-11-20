@props([
    'name' => '',
    'username' => '',
    'image' => '',
    'unreadNotifications' => 0,
])
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
    
    .banner { z-index:1000; }
    .banner-panel { width:240px; height:100vh; background:linear-gradient(160deg,var(--surface-primary),var(--surface-secondary)); border-right:1px solid var(--border-color); display:flex; flex-direction:column; }
    .brand { font-weight:700; letter-spacing:.5px; }
    .nav-primary { list-style:none; padding:0; margin:0 0 1rem; display:flex; flex-direction:column; gap:.25rem; }
    .nav-primary .nav-link { color:#ddd; border-radius:var(--radius-md); padding:.55rem .9rem; font-size:.9rem; display:flex; align-items:center; gap:.6rem; transition:var(--transition-fast); position:relative; }
    .nav-primary .nav-link .bi { font-size:1.05rem; }
    .nav-primary .nav-link:hover { background:rgba(255,255,255,.06); color:#fff; }
    .nav-primary .nav-link.active { background:rgba(255,255,255,.12); color:#fff; font-weight:600; }
    .nav-primary .nav-link.active .bi { filter:drop-shadow(0 0 2px rgba(255,255,255,.2)); }
    .nav-primary .nav-link:focus { outline:2px solid #0d6efd; outline-offset:2px; }
    .notif-badge { position:absolute; top:6px; left:22px; width:8px; height:8px; background:#dc3545; border-radius:50%; box-shadow:0 0 0 2px rgba(0,0,0,.5); }
    .user-block { margin-top:auto; }
    .user-trigger { border-radius:var(--radius-md); padding:.5rem .6rem; transition:var(--transition-fast); }
    .user-trigger:hover { background:rgba(255,255,255,.06); }
    .dropdown-menu.text-small { font-size:.8rem; }
    .dropdown-menu-dark { background:var(--surface-secondary); border:1px solid var(--border-color); }
    .dropdown-menu-dark .dropdown-item { transition:var(--transition-fast); }
    .dropdown-menu-dark .dropdown-item:hover { background:rgba(255,255,255,.08); }
    .avatar-s { width:32px; height:32px; object-fit:cover; border-radius:50%; border:1px solid var(--border-color); }
</style>
@endonce
<div class="banner position-fixed top-0" role="navigation" aria-label="Primary sidebar">
    <div class="banner-panel p-3">
        <a href="/" class="mb-3 text-center text-white text-decoration-none brand">Zafiro</a>
        <ul class="nav-primary mb-auto" role="list">
            <li class="nav-item">
                <a href="{{route('dashboard.home')}}" class="nav-link {{ Route::is('dashboard.home') ? 'active' : '' }}" aria-current="page">
                    <i class="{{ Route::is('dashboard.home') ? 'bi bi-house-door-fill' : 'bi bi-house-door' }}"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.explore')}}" class="nav-link {{ Route::is('dashboard.explore') ? 'active' : '' }}">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts-liked')}}" class="nav-link {{ Route::is('dashboard.posts-liked') ? 'active' : '' }}">
                    <i class="{{ Route::is('dashboard.posts-liked') ? 'bi bi-heart-fill' : 'bi bi-heart' }}"></i>
                    <span>Likes</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts.create')}}" class="nav-link {{ Route::is('dashboard.posts.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-lg"></i>
                    <span>Post</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.notifications')}}" class="nav-link {{ Route::is('dashboard.notifications') ? 'active' : '' }} position-relative">
                    <i class="{{ Route::is('dashboard.notifications') ? 'bi bi-bell-fill' : 'bi bi-bell' }}"></i>
                    @if ($unreadNotifications > 0)
                        <span class="notif-badge" aria-label="Unread notifications"></span>
                    @endif
                    <span>Notifications</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.settings')}}" class="nav-link {{ Route::is('dashboard.settings') ? 'active' : '' }}">
                    <i class="{{ Route::is('dashboard.settings') ? 'bi bi-gear-fill' : 'bi bi-gear' }}"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        <div class="dropdown user-block">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle user-trigger" data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu">
                <img src="{{$image}}" alt="Avatar de {{$username}}" class="avatar-s me-2">
                <div class="d-flex flex-column">
                    <strong class="name" style="font-size: .7rem;">{{$name}}</strong>
                    <strong class="username" style="font-size: .75rem;">{{'@' . $username}}</strong>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="{{route('dashboard.profile', auth()->user()) }}">Profile</a></li>
                @auth
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{route('auth.logout')}}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>