<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class EmptyData extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.empty-data');
    }
}
