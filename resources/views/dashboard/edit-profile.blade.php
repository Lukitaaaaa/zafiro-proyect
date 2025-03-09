@extends('layout.layout')

@section('content')
<main class=" w-100 py-3" style="margin-left: 240px!important;">
    <div class="mx-auto" style="width: 500px;">
        <h3 class="text-center mb-3">Edit profile</h3>
        <form action="{{route('dashboard.profile.update', $user)}}" method="POST" class="d-flex flex-column">
            @csrf
            @method('PUT')
            <div class="col-4 d-flex flex-column align-items-center w-100 mb-3">
                <img src="https://github.com/mdo.png" alt="profile-image" class="rounded-circle" width="200">
            </div>

            <x-form.input label="Name" type="text" id="name" name="name" :required="true" :value="$user->name"/>
            <x-form.input label="Username" type="text" id="username" name="username" :required="true" :value="$user->username"/>

            <div class="mb-2 d-flex flex-column">
                <label for="bio" class="form-label">Bio</label>
                <textarea name="bio" id="bio" cols="30" rows="5">{{$user->bio}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Update</button>
        </form>
    </div>
</main>
@endsection