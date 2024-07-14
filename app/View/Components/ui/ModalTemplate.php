<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class ModalTemplate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $modalID;
    public $modalDialogStyle, $modalDialogClasses, $footerClasses;
    public function __construct($modalID = 'modalID', $modalDialogStyle = '', $modalDialogClasses = '', $footerClasses = '')
    {
        $this->modalID = $modalID;
        $this->modalDialogStyle = $modalDialogStyle;
        $this->modalDialogClasses = $modalDialogClasses;
        $this->footerClasses = $footerClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.modal-template');
    }
}