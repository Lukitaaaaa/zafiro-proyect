@extends('layout.layout')

@section('content')
<main class=" w-100 py-5" style="margin-left: 240px!important;">
    <div class="mx-auto" style="width: 900px;">
        @include('layout.header-profile')
        <hr>
        <div class="mt-3 mx-auto container" style="width: 895px;">
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')    
                    </div>
                @endforeach         
            </div>
        </div>
    </div>
</main>
    
@endsection