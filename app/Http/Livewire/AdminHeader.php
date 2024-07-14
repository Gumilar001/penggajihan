<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class AdminHeader extends Component
{
    public $searchMenu;
    protected $queryString = ["searchMenu"];
    protected $listeners = ['searching'];
    // public $searchResults = null;
    public function render()
    {
        $userid = \Auth::user()->id;
        $role = \Auth::user()->roles->pluck('name')->toArray();

        return view('livewire.admin-header');
    }
}