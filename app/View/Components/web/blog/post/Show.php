<?php

namespace App\View\Components\web\blog\post;

use Illuminate\View\Component;

class Show extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function changeTitle()
    {
        $this->post->title = "Nuevo titulo desde el componente";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.blog.post.show');
    }
}
