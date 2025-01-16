<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\FaqCategory;
use App\Models\MediaCategory;
use Illuminate\View\Component;

class WebHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::has('projects')->get();
        $mediaCategories = MediaCategory::has('medias')->get();
        $faqCategories = FaqCategory::has('faqs')->get();
        return view('components.web-header', compact('categories', 'mediaCategories', 'faqCategories'));
    }
}
