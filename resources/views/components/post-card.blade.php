<div class="card rounded-0 border-0 post-container position-relative ">
    <img src="/storage/{{$post->image}}" class="card-img-top rounded-0 object-fit-cover" alt="..." width="285" height="285" style="outline: none">
    <div class="overlay">
        <div class="interations-container d-flex">
            <div class="likes d-flex  column-gap-2 me-4 align-items-center">
                <i class="bi bi-heart-fill"></i>
                <p class="m-0">{{$post->likes}}</p>
            </div>
            <div class="comments d-flex column-gap-2  align-items-center">
                <i class="bi bi-chat-fill"></i>
                <p class="m-0">0</p>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('posts.show', $post)}}"><i class="bi bi-eye"></i></a>
    </div>
</div>