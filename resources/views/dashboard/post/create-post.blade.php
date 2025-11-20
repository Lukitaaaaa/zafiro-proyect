@extends('layout.layout')

@section('content')
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

    .create-shell { width:750px; background:linear-gradient(145deg,var(--surface-primary),var(--surface-secondary)); border:1px solid var(--border-color); border-radius:var(--radius-lg); padding:1.6rem 1.4rem 1.4rem; margin:0 auto; box-shadow:0 4px 16px -4px rgba(0,0,0,.35); }
    .upload-area { position:relative; width:285px; height:285px; background:var(--surface-secondary); border:1px dashed var(--border-color); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; overflow:hidden; transition:var(--transition-fast); }
    .upload-area:hover { border-color:#3a3a3a; }
    #upload-photo { opacity:0; position:absolute; z-index:-1; }
    .upload-button { cursor:pointer; padding:.55rem 1rem; background:var(--surface-elevated); color:#0d6efd; border-radius:var(--radius-md); font-size:.8rem; font-weight:600; transition:var(--transition-fast); }
    .upload-button:hover { background:#262626; color:#4da3ff; }
    .remove-image-btn { top:10px; left:10px; cursor:pointer; background:rgba(0,0,0,.55); backdrop-filter:blur(4px); border-radius:50%; border:1px solid var(--border-color); width:32px; height:32px; display:flex; align-items:center; justify-content:center; color:#bbb; transition:var(--transition-fast); }
    .remove-image-btn:hover { color:#fff; background:rgba(0,0,0,.75); }
    #description { background:var(--surface-secondary); border:1px solid var(--border-color); color:#eee; }
    #description:focus { background:var(--surface-secondary); color:#fff; box-shadow:0 0 0 2px rgba(13,110,253,.25); }
    .create-submit-btn { font-weight:600; letter-spacing:.5px; }
    .create-submit-btn:disabled { opacity:.45; cursor:not-allowed; }
    .create-submit-btn:not(:disabled) { box-shadow:0 0 0 1px rgba(13,110,253,.4); }
    .create-submit-btn:not(:disabled):hover { filter:brightness(1.1); }
</style>
<div class="w-100 py-3" style="margin-left: 240px">
    <div class="create-shell">
        <h3 class="text-center mb-3">Create post</h3>
        <form action="{{route('dashboard.posts.store')}}" method="POST" enctype="multipart/form-data" id="create-post-form" aria-label="Formulario creación de post">
            @csrf
            <div class="d-flex gap-4">
                <div class="upload-area">
                    <button id="remove-image" class="remove-image-btn d-none position-absolute"><i class="bi bi-x-lg"></i></button>
                    <img src="#" alt="Image preview" id="preview" class="img-fluid d-none w-100 h-100 object-fit-cover">
                    <div id="input-container" class="d-flex flex-column align-items-center justify-content-center h-100">
                        <i class="bi bi-file-image fs-3 mb-1"></i>
                        <span class="small text-muted">Choose your image</span>
                        <label for="upload-photo" class="upload-button mt-3">Select from computer</label>
                        <input type="file" name="image" id="upload-photo" class="upload-photo" accept="image/*"/>
                    </div>
                </div>
                <div class="w-50">
                    <x-form.text-area name="description" id="description" rows="7"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary create-submit-btn w-100 mt-4" id="create-post-btn" disabled>Create</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadPhoto = document.getElementById('upload-photo');
        const preview = document.getElementById('preview');
        const container = document.getElementById('input-container');
        const removeImageBtn = document.getElementById('remove-image');
        const createPostBtn = document.getElementById('create-post-btn');
        const form = document.getElementById('create-post-form');

        uploadPhoto.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.add('d-none');
                    preview.classList.remove('d-none');
                    removeImageBtn.classList.remove('d-none');
                    createPostBtn.disabled = false;
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('d-none');
                removeImageBtn.classList.add('d-none');
                container.classList.remove('d-none');
                createPostBtn.disabled = true;
            }
        });

        removeImageBtn.addEventListener('click', function() {
            uploadPhoto.value = ''; // Clear the file input
            preview.classList.add('d-none');
            removeImageBtn.classList.add('d-none');
            container.classList.remove('d-none');
            createPostBtn.disabled = true;
        });

        form.addEventListener('submit', function() {
            createPostBtn.disabled = true;
        });
    });
</script>
@endsection