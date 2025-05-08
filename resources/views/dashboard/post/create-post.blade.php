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

    .remove-image-btn{
        top: 10px;
        left: 10px;
        cursor: pointer;
        background-color: #1d1b1b;
        border-radius: 50%;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>
<div class=" w-100 py-3" style="margin-left: 240px">
    <div class="mx-auto border border-4 rounded-4 p-3" style="width: 750px; background-color: black;">
        <h3 class="text-center">Create post</h3>
        <hr>
        <form action="{{route('dashboard.posts.store')}}" method="POST" enctype="multipart/form-data" id="create-post-form">
            @csrf
            <div class="d-flex gap-4">
                <div class="position-relative border" style="width: 285px; height: 285px;">
                    <button id="remove-image" class="remove-image-btn d-none position-absolute"><i class="bi bi-x-lg"></i></button>
                    <img src="#" alt="Image preview" id="preview" class="img-fluid d-none w-100 h-100 object-fit-cover">
                    <div id="input-container" class="d-flex flex-column align-items-center justify-content-center h-100">
                        <i class="bi bi-file-image"></i>
                        <span>Choose your image</span>
                        <label for="upload-photo" class="upload-button mt-3">Select from computer</label>
                        <input type="file" name="image" id="upload-photo" class="upload-photo" accept="image/*"/>
                    </div>
                </div>
                <div class="w-50">
                    <x-form.text-area name="description" id="description" rows="7"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4" id="create-post-btn" disabled>Create</button>
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