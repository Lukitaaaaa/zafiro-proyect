@props([
    'name' => '',
    'username' => '',
    'image' => '',
    'unreadNotifications' => 0,
])
<div class="banner position-sticky top-0 right-0 h-100" role="navigation" aria-label="Primary sidebar" x-data>
    <div class="banner-panel p-3">
        <a href="/" class="mb-3 text-center text-white text-decoration-none brand">Zafiro</a>
        <ul class="nav-primary mb-auto" role="list">
            <li class="nav-item">
                <a href="{{route('dashboard.home')}}" 
                    id="nav-link" 
                    class="nav-link navigation {{ Route::is('dashboard.home') ? 'active' : '' }}" 
                    data-route="{{ route('dashboard.home') }}" data-icon="home"
                    aria-current="page" >
                    <i class="{{ Route::is('dashboard.home') ? 'bi bi-house-door-fill' : 'bi bi-house-door' }}"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.explore')}}" 
                    class="nav-link navigation {{ Route::is('dashboard.explore') ? 'active' : '' }}" 
                    data-route="{{ route('dashboard.explore') }}" data-icon="search">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts-liked')}}" 
                    class="nav-link navigation {{ Route::is('dashboard.posts-liked') ? 'active' : '' }}" 
                    data-route="{{ route('dashboard.posts-liked') }}" data-icon="heart">
                    <i class="{{ Route::is('dashboard.posts-liked') ? 'bi bi-heart-fill' : 'bi bi-heart' }}"></i>
                    <span>Likes</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.notifications')}}" 
                    class="nav-link navigation {{ Route::is('dashboard.notifications') ? 'active' : '' }} position-relative" 
                    data-route="{{ route('dashboard.notifications') }}" data-icon="bell">
                    <i class="{{ Route::is('dashboard.notifications') ? 'bi bi-bell-fill' : 'bi bi-bell' }}"></i>
                    @if ($unreadNotifications > 0)
                        <span class="notif-badge" aria-label="Unread notifications"></span>
                    @endif
                    <span>Notifications</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.settings')}}" 
                    class="nav-link navigation {{ Route::is('dashboard.settings') ? 'active' : '' }}" 
                    data-route="{{ route('dashboard.settings') }}" data-icon="gear">
                    <i class="{{ Route::is('dashboard.settings') ? 'bi bi-gear-fill' : 'bi bi-gear' }}"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <button 
                    @click="$dispatch('open-create-post-modal')"
                    class="nav-link bg-primary {{ Route::is('dashboard.posts.create') ? 'active' : '' }}"
                    style="background: none; border: none; width: 100%; text-align: left;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Post</span>
                </button>
            </li>
        </ul>
        <div class="dropdown user-block">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle user-trigger" data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu">
                <img src="{{$image}}" alt="Avatar de {{$username}}" class="avatar me-2" width="32" height="32">
                <div class="d-flex flex-column">
                    <strong class="name" style="font-size: .7rem;">{{$name}}</strong>
                    <strong class="username" style="font-size: .75rem;">{{'@' . $username}}</strong>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item navigation" href="{{route('dashboard.profile', auth()->user()) }}" data-route="{{ route('dashboard.profile', auth()->user())}}">Profile</a></li>
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