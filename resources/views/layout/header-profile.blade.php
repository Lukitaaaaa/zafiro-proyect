<div class="container mb-3">
    <div class="row">
        <div class="col-4 d-flex flex-column align-items-center">
            <img src="{{$user->image}}" alt="{{$user->name}}" class="object-fit-cover rounded-circle mb-4" width="150" height="150">
            @if ($user->id === auth()->user()->id)
                <a class="btn btn-primary w-50" href="{{route('dashboard.profile.edit')}}">Edit</a>
            @else
                <button class="btn btn-primary w-50">Follow</button>
            @endif
        </div>
        <div class="col-8 d-flex flex-column">
            <strong class="name mb-2 fs-2">{{$user->name}}</strong>
            <p class="username mb-2">{{'@'.$user->username}}</p>
            <div class="d-flex mb-2 column-gap-5">
                <p>99999 seguidores</p>
                <p>0 seguidos</p>
            </div>
            <p class="description text-break">{{$user->bio}}</p>
        </div>
        
    </div>
</div>