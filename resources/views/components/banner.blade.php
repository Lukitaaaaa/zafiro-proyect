@props([
    'name' => '',
    'username' => '',
    'image' => ''
])

<style>
    .banner {
        z-index: 1000;
    }
    .banner .nav-link {
        color: white;
        transition: background-color 0.3s, color 0.3s;
    }
    .banner .nav-link:hover {
        background-color: #343a40;
        color: white;
    }
    .banner .nav-link.active {
        background-color: #495057;
        color: white;
    }
    .banner .dropdown-menu {
        background-color: #343a40;
    }
    .banner .dropdown-item:hover {
        background-color: #495057;
        color: white;
    }
</style>
<div class="banner position-fixed top-0">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px; height: 100vh; background-color: black!important;">
        <a href="/" class="mb-md-0 text-center text-white text-decoration-none">
            <span class="fs-4">Zafiro</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route('dashboard.home')}}" class="{{(Route::is('dashboard.home')) ? 'fw-bold':'fw-normal'}} nav-link text-white d-flex align-items-center justify-content-start " aria-current="page">
                    <i class="{{ (Route::is('dashboard.home')) ? 'bi bi-house-door-fill':'bi bi-house-door' }} me-2"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#" class=" nav-link text-white d-flex align-items-center justify-content-start ">
                    <i class="bi bi-search me-2"></i>
                    Search
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts-liked')}}" class="{{(Route::is('dashboard.posts-liked')) ? 'fw-bold':'fw-normal'}} nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="{{ (Route::is('dashboard.posts-liked')) ? 'bi bi-heart-fill':'bi bi-heart' }} me-2"></i>
                    Likes
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts.create')}}" class="{{(Route::is('dashboard.posts.create')) ? 'fw-bold':'fw-normal'}} nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="bi bi-plus-lg me-2"></i>
                    Post
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.settings')}}" class="{{(Route::is('dashboard.settings')) ? 'fw-bold':'fw-normal'}} nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="{{ (Route::is('dashboard.settings')) ? 'bi bi-gear-fill':'bi bi-gear'}} me-2"></i>
                    Settings
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{$image}}" alt="{{$name}}" width="32" height="32" class="object-fit-cover rounded-circle me-2">
            <div class="d-flex flex-column">
                <strong class="name" style="font-size: smaller;">{{$name}}</strong>
                <strong class="username" style="font-size: small;">{{'@' . $username}}</strong>
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{route('dashboard.profile', auth()->user()) }}">Profile</a></li>

            @auth
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{route('auth.logout')}}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">logout</button>
                    </form>
                </li>
            @endauth
            </ul>
        </div>
    </div>
</div>