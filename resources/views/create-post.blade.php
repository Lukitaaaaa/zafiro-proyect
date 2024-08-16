@extends('layout.layout')

@section('content')
<div style="margin-left: 280px">
    <div class="row">
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
                <strong>Por las chanclas de mi madre!</strong> Algo fue mal..<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data"> 
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
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection