<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class UploadPhoto extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data;
    public $labelFor;
    public function __construct($tes = 'invoice2', $labelFor = "idInput")
    {
        $this->data = $tes;
        $this->labelFor = $labelFor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.upload-photo');
    }
    public function mount()
    {

    }
}