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
                <img src="{{$user->image}}" alt="{{$user->name}}" class="rounded-circle object-fit-cover" width="200" height="200" id="preview-image">
                
                <label for="upload-photo" class="upload-button mt-3">Update image</label>
                <input type="file" name="image" id="upload-photo" class="upload-photo" accept="image/*" />
                {{-- TODO: HACER EL BOTON PARA ELIMINAR LA FOTO DE PERFIL --}}
                <button id="remove-image" class="btn btn-danger remove-image-btn d-none mt-3">Remove</button>
            </div>
            

            <input type="hidden" name="remove_image" id="remove_image_check" :value="false">
            {{-- <input type="checkbox" name="remove_image" id="remove_image_check" value="true"> --}}
            <x-form.input label="Name" type="text" id="name" name="name" :required="true" :value="$user->name"/>
            <x-form.input label="Username" type="text" id="username" name="username" :required="true" :value="$user->username"/>

            <x-form.text-area label="Presentation" id="bio" name="bio" rows="2"/>

            <button type="submit" class="btn btn-primary w-100 mt-4">Update</button>
        </form>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadPhoto = document.getElementById('upload-photo');
        const previewImage = document.getElementById('preview-image');
        const removeImageBtn = document.getElementById('remove-image');
        const removeImageCheck = document.getElementById('remove_image_check');
        
        if (previewImage.src !== "{{asset('images/profile.svg')}}" && previewImage.src !== "") {
            removeImageBtn.classList.remove('d-none');
        }

        uploadPhoto.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result; // Actualizar la vista previa con la nueva imagen
                };

                reader.readAsDataURL(file);
            }
        });

        removeImageBtn.addEventListener('click', function (event) {
            event.preventDefault();
            // Limpiar la vista previa y pone la imagen por defecto
            previewImage.src = "{{asset('images/profile.svg')}}"; // Cambia a la imagen por defecto
            removeImageCheck.value = true; // Marcar el checkbox como verdadero
            removeImageBtn.classList.add('d-none'); // Ocultar el botón de eliminar imagen
        });        
    });
</script>
@endsection