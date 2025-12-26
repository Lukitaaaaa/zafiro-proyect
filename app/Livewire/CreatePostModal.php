<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreatePostModal extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $content = '';
    public $image;
    public $imagePreview = null;
    public $urlPrevious;

    protected $rules = [
        'content' => 'nullable|string|max:500',
        'image' => 'required|image|max:5120', // 5MB
    ];

    protected $messages = [
        'content.max' => 'Your post is too long. Maximum 500 characters.',
        'image.required' => 'Please upload an image.',
        'image.image' => 'The file must be an image.',
        'image.max' => 'The image size cannot exceed 5MB.',
    ];
 
    // Validación en tiempo real
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImage()
    {
        $this->validate(['image' => 'nullable|image|max:5120']);
        
        if ($this->image) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->urlPrevious = url()->previous();
        $url = url('posts/create');
        $this->js("history.replaceState({}, '', '$url');"); 
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'content', 'image', 'imagePreview']);
        $this->resetValidation();
        $this->js("history.replaceState({}, '', '$this->urlPrevious');");
    }

    public function removeImage()
    {
        $this->reset(['image', 'imagePreview']);
    }

    public function createPost()
    {
        $this->validate();

        $post = new Post();
        $post->description = $this->content;
        $post->user_id = auth()->id();

        if ($this->image) {
            $path = $this->image->store('posts', 'public');
            $post->image = $path;
        }

        $post->save();

        // Cargar conteos
        $post->loadCount(['likes', 'comments']);

        // Emitir evento para actualizar el feed
        $this->dispatch('post-created', postHtml: view('components.post-card', ['post' => $post])->render());

        // Cerrar modal y resetear
        $this->closeModal();

        // Flash message
        session()->flash('post-created', 'Post created successfully!');
    }

    public function render()
    {
        return view('livewire.create-post-modal');
    }
}