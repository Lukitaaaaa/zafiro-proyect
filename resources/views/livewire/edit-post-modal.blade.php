<div
    x-data
    @open-edit-post-modal.window="$wire.openModal()">
    {{-- Flash message --}}
    @if (session()->has('post-updated'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             style="z-index: 9999;" role="alert">
            {{ session('post-updated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Modal --}}
    @if($showModal)
        <div class="modal fade modal-show show d-block" 
             tabindex="-1" 
             wire:click.self="closeModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    {{-- Header --}}
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Edit post</h5>
                        <button type="button" 
                                class="btn-close" 
                                wire:click="closeModal"
                                aria-label="Close"></button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body pt-2">
                        <form wire:submit.prevent="updatePost">
                            {{-- User info --}}
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ auth()->user()->image }}" 
                                    alt="{{ auth()->user()->name }}" 
                                    width="40" 
                                    height="40" 
                                    class="rounded-circle me-2 object-fit-cover">
                                <div>
                                    <strong class="d-block" style="font-size: 0.9rem;">{{ auth()->user()->name }}</strong>
                                    <small class="text-muted">{{ '@' . auth()->user()->username }}</small>
                                </div>
                            </div>

                            
                            {{-- Image Preview --}}
                            
                            <div class="mb-3 position-relative">
                                @if($post->image == "http://127.0.0.1:8000/images/post.svg")
                                    <img src="{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
                                @else
                                    <img src="/storage/{{$post->image}}" alt="Imagen del post de {{ $post->user->username }}" class="post-image w-100">
                                @endif
                                {{-- <img src="/storage/{{$post->image}}" 
                                        class="img-fluid rounded" 
                                        alt="Preview"
                                        style="max-height: 400px; width: 100%; object-fit: contain;">
                                 --}}
                            </div>
                            

                            {{-- Textarea --}}
                            <div class="mb-3">
                                <textarea 
                                    wire:model.live="content" 
                                    class="form-control border-0 @error('content') is-invalid @enderror" 
                                    placeholder="What's on your mind, {{ auth()->user()->name }}?" 
                                    rows="4"
                                    style="resize: none; font-size: 1.1rem;"
                                    autofocus></textarea>
                                @error('content')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                
                                {{-- Character counter --}}
                                <div class="text-end">
                                    <small class="text-muted">{{ strlen($content) }}/500</small>
                                </div>
                            </div>

                            {{-- Footer Actions --}}
                            <div class="d-flex justify-content-end align-items-center border-top pt-3 mt-3">

                                <button 
                                    type="submit" 
                                    class="btn btn-primary px-4"
                                    wire:loading.attr="disabled"
                                    wire:target="updatePost">
                                    
                                    <span wire:loading.remove wire:target="updatePost">Update</span>
                                    <span wire:loading wire:target="updatePost">
                                        <span class="spinner-border spinner-border-sm me-1"></span>
                                        Updating...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
