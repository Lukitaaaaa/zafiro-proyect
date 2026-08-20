<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPostModal extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $post;
    public $content = '';
    public $image;
    public $urlPrevious;

    protected $rules = [
        'content' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'content.max' => 'Your post is too long. Maximum 500 characters.',
    ];

    public function mount($post)
    {
        $this->post = $post;
        $this->content = $this->post->description;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->content = $this->post->description;
        
        $this->urlPrevious = url()->previous();
        $url = url("posts/{$this->post->id}/edit");
        $this->js("history.replaceState({}, '', '$url');");
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'content', 'image']);
        $this->resetValidation();

        $this->js("history.replaceState({}, '', '$this->urlPrevious');");
    }

    public function updatePost()
    {
        $this->validate();

        $this->post->description = $this->content;

        $this->post->save();

        // Sync hashtags from description
        $this->post->syncTagsFromDescription();

        // Emitir evento para actualizar el post en la interfaz
        $this->dispatch('post-updated', [
            'postId' => $this->post->id,
            'description' => hashtagsToLinks($this->post->description),
        ]);

        // Cerrar modal y resetear
        $this->closeModal();

        session()->flash('post-updated', 'Post updated successfully!');
    }

    public function render()
    {
        return view('livewire.edit-post-modal');
    }
}
