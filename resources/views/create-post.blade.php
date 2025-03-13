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
<div class=" w-100 py-3" style="margin-left: 240px">
    <div class="mx-auto border border-4 rounded-4 p-3" style="width: 750px; background-color: black;">
        <h3 class="text-center">Create post</h3>
        <hr>
        <form action="{{route('dashboard.posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex gap-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="width: 285px; height: 285px;">
                    <i class="bi bi-file-image"></i>
                    <span>Choose your image</span>
                    <label for="upload-photo" class="upload-button mt-3">Select from computer</label>
                    <input type="file" name="image" id="upload-photo" class="upload-photo" />
                </div>
                <div class="w-50">
                    <x-form.text-area label="Description" name="description" id="description" rows="7"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4">Create</button>
        </form>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <div>
                <h2>Create Post</h2>
            </div>
            <div>
                <a href="#" class="btn btn-primary">Volver</a>
            </div>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{route('dashboard.posts.store')}}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Descripción..." ></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div> --}}
</div>

@endsection