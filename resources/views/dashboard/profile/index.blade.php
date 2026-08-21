@extends('layout.layout')

@section('content')
<main class="w-100 py-5"
    x-data
    @post-created.window="
        const column = document.createElement('div');
        column.classList.add('columna', 'col');
        column.innerHTML = $event.detail.postHtml;

        const row = document.querySelector('.profile-posts');
        row.insertAdjacentElement('afterbegin', column);
    ">
    <div class="mx-auto" style="width: 900px;">
        @include('layout.header-profile')
        <hr>
        <div class="mt-3 mx-auto container" style="width: 895px;">
            <div class="profile-posts row row-cols-2 row-cols-md-3 gap-2 mx-auto" data-infinite-scroll-container data-has-more="{{ $posts->hasMorePages() ? 'true' : 'false' }}">
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