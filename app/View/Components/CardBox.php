<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $cardTitle
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-box');
    }
}
