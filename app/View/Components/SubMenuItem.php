<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $menuTitle = '',
        public string $classActive = '',
        public string $route = '',
        public string $param = '',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sub-menu-item');
    }
}
