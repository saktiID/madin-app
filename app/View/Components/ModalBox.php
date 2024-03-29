<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $modalId,
        public string $modalTitle,
        public string $modalUrl,
        public string $modalSubmitText,
        public string $classSubmit = 'primary',
        public string $modalFormMethod = 'GET',
        public string $modalSizeClass = '',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-box');
    }
}
