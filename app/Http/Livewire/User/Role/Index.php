<?php

namespace App\Http\Livewire\User\Role;

use App\Models\MasterPermission;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $deleteId;
    protected $listeners = ['confirmedDelete'];
    protected $queryString = ["search"];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchValue = $this->search;

        $data = Role::with('permissions')
            ->orderBy('id', 'DESC');

        if ($this->search) {
            $data = $data->where(function ($data) use ($searchValue) {
                $data->Where('name', 'like', '%' . $searchValue . '%');
            });
        }
        $data = $data->paginate(10);

        foreach ($data as $key => $value) {
            $item = [];
            foreach ($value->permissions as $key => $f) {
                array_push($item, $f->master_permission_id);
            }
            $item = collect($item)->unique();

            $mps = MasterPermission::whereIn('id', $item)->get();
            $menu = [];
            foreach ($mps as $idx => $val) {
                $_menu = [
                    'icon' => $val->icon,
                    'title' => $val->permission_title
                ];
                array_push($menu, $_menu);
            }
            
            $value['menu'] = $menu;
        }

        return view('livewire.user.role.index', ["role" => $data]);
    }

    public function delete($id)
    {

        $this->deleteId = $id;
        $this->alert('question', 'Hapus Data Role?', [
            'toast' => false,
            'timer' => null,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Hapus',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmedDelete',
            'cancelButtonText' => 'Batal',
            'confirmButtonColor' => '#EB5757',
            'customClass' => [
                'confirmButton' => 'shadow-none',
                'cancelButton' => 'shadow-none',
            ]
        ]);
    }
    public function confirmedDelete()
    {
        Role::findById($this->deleteId)->delete();
        $this->alert('success', 'Data Role berhasil dihapus');
    }
}