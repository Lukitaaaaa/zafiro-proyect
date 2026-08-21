@foreach ($posts as $post)
    <div class="columna col">
        @include('components.post-card')
    </div>
@endforeach
