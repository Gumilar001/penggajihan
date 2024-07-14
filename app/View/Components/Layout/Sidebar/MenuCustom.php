<?php

namespace App\View\Components\Layout\Sidebar;

use Illuminate\View\Component;

class MenuCustom extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $active;
     public $to;
     public $parent;
     public $menuType;
     public function __construct($active = false, $to = '/', $parent = 1, $menuType=null)
     {
         $this->active = $active;
         $this->to = $to;
         $this->parent = $parent;
         $this->menuType = $menuType;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.sidebar.menu-custom');
    }
}
