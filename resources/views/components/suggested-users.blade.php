@props(['users'])

<div class="how-to-follow-container">
    <div class="follow-shell position-sticky me-3" aria-label="Suggestions to follow" style="top: 1rem;">
        <h5 class="mb-2 fw-semibold">Who to follow</h5>
        <div class="follow-list">
            @foreach ($users as $user)
                <div class="follow-item">
                    <div class="">
                        <img src="{{ $user->image }}" alt="{{ $user->name }} avatar" class="avatar" width="32" height="32">
                    </div>
                    <div class="overflow-hidden" style="min-width:0;">
                        <a class="mb-0 small text-truncate d-block" href="{{route('dashboard.profile', $user)}}">{{ $user->name }}</a>
                        <p class="mb-0 text-truncate" style="max-width:140px;">{{ '@' . $user->username }}</p>
                    </div>
                    <form action="{{ route('dashboard.profile.follow', $user->id)}}" method="post" class="ms-auto" aria-label="Follow {{ $user->username }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                    <a href="{{ route('dashboard.profile', $user) }}" class="position-absolute w-100 h-100"></a>
                </div>
            @endforeach
        </div>
        <div class="show-more-wrapper">
            <a href="{{ route('dashboard.show-users') }}" aria-label="Show more user suggestions">Show More</a>
        </div>
    </div>
</div>