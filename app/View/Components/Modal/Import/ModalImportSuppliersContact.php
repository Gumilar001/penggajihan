<?php

namespace App\View\Components\Modal\Import;

use Illuminate\View\Component;

class ModalImportSuppliersContact extends Component
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
        return view('components.modal.import.modal-import-suppliers-contact');
    }
}
