<?php

namespace App\View\Components\post;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post as PostModel;
class post extends Component
{
    /**
     * Create a new component instance.
     */
    public PostModel|null $post;
    public bool $clickable;
    public function __construct(PostModel $post = null, bool $clickable = true)
    {
        $this->post = $post;
        $this->clickable = $clickable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.post');
    }
}
