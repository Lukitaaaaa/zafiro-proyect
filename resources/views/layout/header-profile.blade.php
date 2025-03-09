<div class="container mb-3">
    <div class="row">
        <div class="col-4 d-flex flex-column align-items-center">
            <img src="https://github.com/mdo.png" alt="profile-image" class="rounded-circle mb-4" width="150">
            <a class="btn btn-primary w-50" href="{{route('dashboard.profile.edit')}}">Edit</a>
        </div>
        <div class="col-8 d-flex flex-column">
            <strong class="name mb-2 fs-2">{{auth()->user()->name}}</strong>
            <p class="username mb-2">{{auth()->user()->username}}</p>
            <div class="d-flex mb-2 column-gap-5">
                <p>99999 seguidores</p>
                <p>0 seguidos</p>
            </div>
            <p class="description text-break">{{auth()->user()->bio}}</p>
        </div>
        
    </div>
</div>