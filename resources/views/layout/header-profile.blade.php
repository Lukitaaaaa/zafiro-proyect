<div class="container mb-3">
    <div class="row">
        <div class="col-4 d-flex flex-column align-items-center">
            <img src="{{$user->image}}" alt="{{$user->name}}" class="avatar mb-4" width="150" height="150">
            @if ($user->id === auth()->user()->id)
                <a class="btn btn-primary w-50" href="{{route('dashboard.profile.edit')}}">Edit</a>
            @else
                @if(auth()->user()->isFollowing($user))
                    <form action="{{ route( 'dashboard.profile.unfollow', $user)}}" method="post" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-outline-light w-100">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route( 'dashboard.profile.follow', $user)}}" method="post" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Follow</button>
                    </form>
                @endif
            @endif
        </div>
        <div class="col-8 d-flex flex-column">
            <strong class="name mb-2 fs-2">{{$user->name}}</strong>
            <p class="username mb-2">{{'@'.$user->username}}</p>
            <div class="d-flex mb-2 column-gap-5">
                <p>{{ $user->followers()->count() . ' followers'}}</p>
                <p>{{ $user->followings()->count() . ' followings' }}</p>
                <p>{{ $user->posts()->count() . ' posts' }}</p>
            </div>
            <p class="description text-break">{{$user->bio}}</p>
        </div>
        
    </div>
</div>