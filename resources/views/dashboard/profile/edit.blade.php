@extends('layout.layout')

@section('content')
<style>
    .upload-button {
        cursor: pointer;
        padding: 5px 10px;
        background-color: #007bff;
        border-radius: 5px;
    }

    #upload-photo {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }

</style>
<main class=" w-100 py-3" style="margin-left: 240px!important;">
    <div class="mx-auto border border-4 rounded-4 p-3" style="width: 500px; background-color: black;">
        <h3 class="text-center mb-3">Edit profile</h3>
        <form action="{{route('dashboard.profile.update', $user)}}" method="POST" enctype="multipart/form-data" class="d-flex flex-column">
            @csrf
            @method('PUT')
            <div class="col-4 d-flex flex-column align-items-center w-100 mb-3">
                <img src="{{$user->image}}" alt="{{$user->name}}" class="rounded-circle object-fit-cover" width="200" height="200">
                
                <label for="upload-photo" class="upload-button mt-3">Update image</label>
                <input type="file" name="image" id="upload-photo" class="upload-photo" />
                {{-- TODO: HACER EL BOTON PARA ELIMINAR LA FOTO DE PERFIL --}}
            </div>
            

            
            <x-form.input label="Name" type="text" id="name" name="name" :required="true" :value="$user->name"/>
            <x-form.input label="Username" type="text" id="username" name="username" :required="true" :value="$user->username"/>

            <x-form.text-area label="Presentation" id="bio" name="bio" rows="2"/>
            {{-- <div class="mb-2">
                <label for="exampleFormControlTextarea1" class="form-label">Presentation</label>
                <textarea class="form-control" name="bio" id="bio" rows="3">{{$user->bio}}</textarea>
            </div> --}}

            <button type="submit" class="btn btn-primary w-100 mt-4">Update</button>
        </form>
    </div>
</main>
@endsection