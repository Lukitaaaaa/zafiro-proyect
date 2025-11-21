@props([
    'name' => '',
    'username' => '',
    'image' => '',
    'unreadNotifications' => 0,
])
<div class="banner position-fixed top-0" role="navigation" aria-label="Primary sidebar">
    <div class="banner-panel p-3">
        <a href="/" class="mb-3 text-center text-white text-decoration-none brand">Zafiro</a>
        <ul class="nav-primary mb-auto" role="list">
            <li class="nav-item">
                <a href="{{route('dashboard.home')}}" id="nav-link" class="nav-link {{ Route::is('dashboard.home') ? 'active' : '' }}" aria-current="page" onclick="routeTo('{{ route('dashboard.home') }}')">
                    <i class="{{ Route::is('dashboard.home') ? 'bi bi-house-door-fill' : 'bi bi-house-door' }}"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.explore')}}" class="nav-link {{ Route::is('dashboard.explore') ? 'active' : '' }}" onclick="routeTo('{{ route('dashboard.explore') }}')">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.posts-liked')}}" class="nav-link {{ Route::is('dashboard.posts-liked') ? 'active' : '' }}" onclick="routeTo('{{ route('dashboard.posts-liked') }}')">
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
                <a href="{{route('dashboard.notifications')}}" class="nav-link {{ Route::is('dashboard.notifications') ? 'active' : '' }} position-relative" onclick="routeTo('{{ route('dashboard.notifications') }}')">
                    <i class="{{ Route::is('dashboard.notifications') ? 'bi bi-bell-fill' : 'bi bi-bell' }}"></i>
                    @if ($unreadNotifications > 0)
                        <span class="notif-badge" aria-label="Unread notifications"></span>
                    @endif
                    <span>Notifications</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.settings')}}" class="nav-link {{ Route::is('dashboard.settings') ? 'active' : '' }}" onclick="routeTo('{{ route('dashboard.settings') }}')">
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
{{-- <script>
    
    console.log('Banner loaded');
    function routeTo(route) {
        event.preventDefault();
        const CRSF_TOKEN = $("meta[name='csrf-token']").attr('content');
        console.log(route);
        $.ajax({
            url: route,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': CRSF_TOKEN
            },
            success: function(response) {
                //console.log(response);
                $('main').html($(response).find('main').html());
                history.pushState({}, '', route);
                //aplicar estilo active al nav-link
                $('.nav-link').removeClass('active');
                $(`a[href='${route}']`).addClass('active');
            },
            error: function(xhr) {
                // Handle error
                console.error('Error navigating to home:', xhr);
            }
        });
    }
</script> --}}