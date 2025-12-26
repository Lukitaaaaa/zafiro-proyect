{{-- filepath: c:\wamp64\www\zafiro-proyect\resources\views\livewire\create-post-modal.blade.php --}}
<div
    x-data
    @open-create-post-modal.window="$wire.openModal()">
    {{-- Flash message --}}
    @if (session()->has('post-created'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             style="z-index: 9999;" role="alert">
            {{ session('post-created') }}
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
                        <h5 class="modal-title fw-bold">Create new post</h5>
                        <button type="button" 
                                class="btn-close" 
                                wire:click="closeModal"
                                aria-label="Close"></button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body pt-2">
                        <form wire:submit.prevent="createPost">
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

                            {{-- Drag & Drop Area --}}
                            @if(!$imagePreview)
                                <div 
                                    x-data="{ 
                                        isDragging: false,
                                        handleDrop(e) {
                                            this.isDragging = false;
                                            const files = e.dataTransfer.files;
                                            if (files.length > 0) {
                                                @this.upload('image', files[0])
                                            }
                                        }
                                    }"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="handleDrop($event)"
                                    :class="{ 'border-primary ': isDragging }"
                                    class="upload-area">
                                    
                                    <label for="image-upload" class="d-block w-100 h-100 d-flex flex-column justify-content-center" style="cursor: pointer;">
                                        <i class="bi bi-image fs-1 text-muted d-block mb-2"></i>
                                        <p class="mb-1 fw-semibold">Drag & drop your image here</p>
                                        <p class="text-muted small mb-2">or click to browse</p>
                                        <input 
                                            type="file" 
                                            id="image-upload" 
                                            wire:model="image" 
                                            accept="image/*" 
                                            class="d-none">
                                    </label>
                                    
                                    {{-- Loading state --}}
                                    <div wire:loading wire:target="image" class="mt-2">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="small text-muted mt-1">Uploading...</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Image Preview --}}
                            @if($imagePreview)
                                <div class="mb-3 position-relative">
                                    <img src="{{ $imagePreview }}" 
                                         class="img-fluid rounded" 
                                         alt="Preview"
                                         style="max-height: 400px; width: 100%; object-fit: contain;">
                                    
                                    {{-- Remove button --}}
                                    <button 
                                        type="button" 
                                        wire:click="removeImage"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 rounded-circle"
                                        style="width: 32px; height: 32px; padding: 0;">
                                        <i class="bi bi-x fs-5"></i>
                                    </button>
                                </div>
                            @endif

                            {{-- Error de imagen --}}
                            @error('image')
                                <div class="alert alert-danger py-2">{{ $message }}</div>
                            @enderror

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
                                    wire:target="createPost"
                                    x-bind:disabled="!$wire.image">
                                    
                                    <span wire:loading.remove wire:target="createPost">Post</span>
                                    <span wire:loading wire:target="createPost">
                                        <span class="spinner-border spinner-border-sm me-1"></span>
                                        Posting...
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
