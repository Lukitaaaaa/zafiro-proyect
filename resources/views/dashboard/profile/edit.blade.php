@extends('layout.layout')

@section('content')
@once
<style>
    
    :root {
        --surface-primary: #111;
        --surface-secondary: #181818;
        --surface-elevated: #202020;
        --border-color: #2a2a2a;
        --radius-lg: 1.25rem;
        --radius-md: .75rem;
        --transition-fast: .18s ease;
    }
    
    .profile-shell { width:500px; background:linear-gradient(145deg,var(--surface-primary),var(--surface-secondary)); border:1px solid var(--border-color); border-radius:var(--radius-lg); padding:1.6rem 1.4rem 1.4rem; margin:0 auto; box-shadow:0 4px 16px -4px rgba(0,0,0,.35); }
    .profile-shell h3 { font-weight:600; }
    .avatar-large { width:200px; height:200px; border-radius:50%; object-fit:cover; border:3px solid var(--surface-elevated); box-shadow:0 0 0 2px rgba(255,255,255,.04); }
    #upload-photo { opacity:0; position:absolute; z-index:-1; }
    .upload-button { cursor:pointer; padding:.55rem 1rem; background:var(--surface-elevated); color:#0d6efd; border-radius:var(--radius-md); font-size:.8rem; font-weight:600; transition:var(--transition-fast); }
    .upload-button:hover { background:#262626; color:#4da3ff; }
    .remove-image-btn { cursor:pointer; padding:.5rem .9rem; font-size:.75rem; font-weight:600; border-radius:var(--radius-md); background:#2c1215; color:#ff6b6b; border:1px solid #551f26; transition:var(--transition-fast); }
    .remove-image-btn:hover { background:#44181d; color:#ffa8a8; }
    .remove-image-btn.d-none { display:none !important; }
    #bio, #name, #username { background:var(--surface-secondary); border:1px solid var(--border-color); color:#eee; }
    #bio:focus, #name:focus, #username:focus { background:var(--surface-secondary); color:#fff; box-shadow:0 0 0 2px rgba(13,110,253,.25); }
    .profile-submit-btn { font-weight:600; letter-spacing:.5px; }
    .profile-submit-btn:disabled { opacity:.45; cursor:not-allowed; }
    .profile-submit-btn:not(:disabled) { box-shadow:0 0 0 1px rgba(13,110,253,.4); }
    .profile-submit-btn:not(:disabled):hover { filter:brightness(1.1); }
</style>
@endonce
<main class="w-100 py-3" style="margin-left: 240px!important;">
    <div class="profile-shell" aria-label="Editar perfil">
        <h3 class="text-center mb-3">Edit profile</h3>
        <form action="{{route('dashboard.profile.update', $user)}}" method="POST" enctype="multipart/form-data" class="d-flex flex-column" aria-label="Formulario de edición de perfil">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column align-items-center w-100 mb-3">
                <img src="{{$user->image}}" alt="{{$user->name}} avatar" class="avatar-large" id="preview-image">
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