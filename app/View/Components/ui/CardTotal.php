<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class CardTotal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $icon = null;
    public $wrapperClass = null;
    public function __construct($icon = null, $wrapperClass = null)
    {
        //
        $this->icon = $icon;
        $this->wrapperClass = $wrapperClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.card-total');
    }
}
