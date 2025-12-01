@extends('layout.layout')

@section('content')
<main class="w-100 py-3">
    <div class="profile-shell" aria-label="Editar perfil">
        <h3 class="text-center mb-3">Edit profile</h3>
        <form action="{{route('dashboard.profile.update', $user)}}" method="POST" enctype="multipart/form-data" class="d-flex flex-column" aria-label="Formulario de edición de perfil">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column align-items-center w-100 mb-3">
                <img src="{{$user->image}}" alt="{{$user->name}} avatar" class="avatar-large" id="preview-image" data-default-image="{{ asset('images/profile.svg') }}">
                <label for="upload-photo" class="upload-button mt-3" aria-label="Subir nueva imagen de perfil">Update image</label>
                <input type="file" name="image" id="upload-photo" class="upload-photo" accept="image/*" aria-label="Archivo de imagen de perfil" />
                <button id="remove-image" class="remove-image-btn d-none mt-3" aria-label="Eliminar imagen de perfil">Remove</button>
            </div>
            

            <input type="hidden" name="remove_image" id="remove_image_check" :value="false">
            {{-- <input type="checkbox" name="remove_image" id="remove_image_check" value="true"> --}}
            <x-form.input label="Name" type="text" id="name" name="name" :required="true" :value="$user->name"/>
            <x-form.input label="Username" type="text" id="username" name="username" :required="true" :value="$user->username"/>

            <x-form.text-area label="Presentation" id="bio" name="bio" rows="2"/>

            <button type="submit" class="btn btn-primary profile-submit-btn w-100 mt-4">Update</button>
        </form>
    </div>
</main>
@vite('resources/js/profile-edit.js')
@endsection