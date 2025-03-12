@props([
    'description' => '',
    'image' => '',
    'likes' => 0,
    'created' => ''
])

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body d-flex flex-row">
            <img src="/storage/{{$image}}" class="object-fit-cover" alt="post-image" width="285" height="285">
            <div class="ms-3 d-flex flex-column justify-content-between" ">
                <span>{{$description}}</span>
                <div class="d-flex justify-content-between">
                    <div class="d-flex column-gap-4">
                        <div class="likes d-flex  column-gap-2 align-items-center">
                            <i class="bi bi-heart-fill"></i>
                            <p class="m-0">{{$likes}}</p>
                        </div>
                        <div class="comments d-flex column-gap-2  align-items-center">
                            <i class="bi bi-chat-fill"></i>
                            <p class="m-0">0</p>
                        </div>
                    </div>
                    <strong>{{$created}}</strong>
                </div>
            </div>   
        </div>
      </div>
    </div>
</div>