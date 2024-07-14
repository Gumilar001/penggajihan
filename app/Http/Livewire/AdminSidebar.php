<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;

class AdminSidebar extends Component
{
    // public $userId;
    public $listMaster = [
        'view master perusahaan',
        'create master perusahaan',
        'edit master perusahaan',
        'delete master perusahaan',
        'view master proyek',
        'create master proyek',
        'edit master proyek',
        'delete master proyek',
        'view master bank',
        'create master bank',
        'edit master bank',
        'delete master bank',
        'view master deskripsi',
        'create master deskripsi',
        'edit master deskripsi',
        'delete master deskripsi',
    ];
    public $listUsers = [
        'view users',
        'create users',
        'edit users',
        'delete users',
        'view role',
        'create role',
        'edit role',
        'delete role'
    ];
    public function render()
    {
        return view('livewire.admin-sidebar');
    }

    public function mount()
    {
        // $this->userId = Auth::user()->id;
    }
}