@extends('layout.layout')

@section('content')
<main class=" w-100 py-5" style="margin-left: 240px!important;">
    <div class="mx-auto" style="width: 900px;">
        @include('layout.header-profile')
        <hr>
        <div class="mt-3 mx-auto d-flex" style="width: 895px;">
            <img src="/storage/{{$post->image}}" class="object-fit-cover" width="285" height="285">
            <div class="ms-3 d-flex flex-column position-relative" style="width: 100%;">
                @if ($editing)
                    <form action="{{route('posts.update', $post)}}" method="POST" class="mb-auto position-relative d-flex">
                        @csrf
                        @method('PUT')
                        <textarea name="description" id="description" cols="30" rows="5" class=" w-75 fs-3">{{$post->description}}</textarea>
                        <div class="position-absolute end-0 mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                @else 
                    <span class="mb-auto fs-3 w-75 text-break">{{$post->description}}</span>   
                    <div class="position-absolute end-0 mt-3">
                        <div class="d-flex flex-column row-gap-3">
                            <a href="{{route('profile')}}" class="btn btn-primary">Close</a>
                            <a href="{{route('posts.edit', $post)}}" class="btn btn-warning">Edit</a>
                            <form id="form_{{$post->id}}" action="{{route('posts.destroy', $post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" {{--data-bs-toggle="modal" data-bs-target="#modalConfirmation"--}}>Remove</button>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="d-flex justify-content-between">
                    <div class="d-flex column-gap-4">
                        <div class="likes d-flex  column-gap-2 align-items-center">
                            <i class="bi bi-heart-fill"></i>
                            <p class="m-0">{{$post->likes}}</p>
                        </div>
                        <div class="comments d-flex column-gap-2  align-items-center">
                            <i class="bi bi-chat-fill"></i>
                            <p class="m-0">0</p>
                        </div>
                    </div>
                    <strong>{{$post->created_at}}</strong>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- <div class="modal" tabindex="-1" id="modalConfirmation">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">¿Are you sure to delete this post?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="btnEliminar">Yes, i sure</button>
        </div>
      </div>
    </div>
</div> --}}
@endsection
{{-- @section('js')
    @vite(['resources/js/Posts/index.js'])
@endsection --}}