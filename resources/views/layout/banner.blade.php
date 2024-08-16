<div class="banner position-fixed top-0">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px; height: 100vh; background-color: black!important;">
        <a href="/" class="mb-md-0 text-center text-white text-decoration-none">
            <span class="fs-4">Zafiro</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link text-white d-flex align-items-center justify-content-start " aria-current="page">
                    <i class="bi bi-house-door me-2"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white d-flex align-items-center justify-content-start ">
                    <i class="bi bi-search me-2"></i>
                    Search
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="bi bi-heart me-2"></i>
                    Likes
                </a>
            </li>
            <li>
                <a href="{{route('posts.create')}}" class="nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="bi bi-plus-lg me-2"></i>
                    Post
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white d-flex align-items-center justify-content-start">
                    <i class="bi bi-gear me-2"></i>
                    Settings
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <div class="d-flex flex-column">
                <strong class="name" style="font-size: smaller;">Lucas Gallardo</strong>
                <strong class="username" style="font-size: small;">@lukita</strong>
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>