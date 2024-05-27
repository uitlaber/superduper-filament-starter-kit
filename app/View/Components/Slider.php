<?php

namespace App\View\Components;

use App\Models\Banner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $banners = Banner::all();
        return view('components.slider', compact('banners'));
    }
}
