<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PhaseMultiImage extends Component
{
    public $images, $textName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($images, $name)
    {
        $this->images = $images;
        $this->textName = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.phase-multi-image');
    }
}
