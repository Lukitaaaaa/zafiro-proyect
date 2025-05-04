<div class="card rounded-0 border-0 post-container position-relative">
    <img src="{{$post->image}}" class="card-img-top rounded-0 object-fit-cover position-absolute" alt="..." width="285" height="285" style="outline: none">
    <div class="overlay">
        <div class="interations-container d-flex">
            <div class="likes d-flex  column-gap-2 me-4 align-items-center">
                <i class="bi bi-heart-fill"></i>
                <p class="m-0">{{$post->likes_count}}</p>
            </div>
            <div class="comments d-flex column-gap-2  align-items-center">
                <i class="bi bi-chat-fill"></i>
                <p class="m-0">{{$post->comments_count}}</p>
            </div>
        </div>
        
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-eye"></i>
        </button> --}}
    </div>
    <a class="w-100 h-100 position-absolute" href="{{route('dashboard.posts.show', $post)}}"></a>
</div>
{{-- <x-post.post-modal :description="$post->description" :image="$post->image" :created="$post->created_at"/> --}}