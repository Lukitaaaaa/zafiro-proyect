@extends('layout.layout')

@section('content')
<main class="d-flex flex-row w-100" style="margin-left: 240px;">
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 895px;">
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')    
                    </div>
                @endforeach               
            </div>
        </div>
    </div>
    <div class="how-to-follow-container pt-3">
        <div class="card me-3">
            <div class="card-header pb-0 border-0">
                <h5 class="">Who to follow</h5>
            </div>
            <div class="card-body">
                <div class="hstack gap-2 mb-3">
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle"
                            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt=""></a>
                    </div>
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Mario Brother</a>
                        <p class="mb-0 small text-truncate">@Mario</p>
                    </div>
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="bi bi-plus-lg"> </i></a>
                </div>
                <div class="hstack gap-2 mb-3">
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle"
                                src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt=""></a>
                    </div>
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Mario Brother</a>
                        <p class="mb-0 small text-truncate">@Mario</p>
                    </div>
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="bi bi-plus-lg"> </i></a>
                </div>
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="#!">Show More</a>
                </div>
            </div>
        </div>
        
    </div>
</main>
    
@endsection
