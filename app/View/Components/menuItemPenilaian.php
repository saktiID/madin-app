<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class menuItemPenilaian extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $menuTitle = '',
        public string $menuIcon = '',
        public string $route = '',
        public string $classActive = '',
        public string $dataToggle = '',
        public string $dataTarget = '',
        public string $pelajaranId = '',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-item-penilaian');
    }
}
