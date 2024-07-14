<?php

namespace App\Http\Livewire\User\Role;

use App\Http\Services\PermissionService;
use App\Models\MasterPermission;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;

class Add extends Component
{

    use LivewireAlert;
    public $accessMenu = '';
    public $listPermissions = [];
    public $postData = [
        'role_name' => null,
    ];

    public $role_name, $is_active = true, $permission_id = [];

    protected $listeners = ['addPermissionId', 'removePermissionId', 'removeAllFromId'];

    protected $rules = [
        'postData.role_name' => 'required|unique:roles,name',
        'accessMenu' => 'required',
    ];
    protected $messages = [
        'postData.role_name.required' => 'Nama Role tidak boleh kosong',
        'postData.role_name.unique' => 'Nama Role sudah digunakan',
        'accessMenu.required' => 'Pilih Akses',
    ];


    public function render()
    {
        return view('livewire.user.role.add');
    }

    public function mount()
    {
        $this->getListPermission();
    }

    public function setStatus($value)
    {
        $this->is_active = $value;
    }

    public function getListPermission()
    {
        $this->listPermissions = MasterPermission::with('permission')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $data = [
                'role_name' => $this->postData['role_name'],
                'is_active' => $this->is_active,
                'permission_id' => []
            ];

            $role = Role::create(
                [
                    'name' => strtolower($data['role_name']),
                    'guard_name' => 'web'
                ]
            );
            foreach ($this->permission_id as $key => $value) {
                $cek = Permission::find($value);
                if ($cek) {
                    $role->givePermissionTo($cek);
                }
            }
            $this->alert('success', 'Data berhasil ditambahkan');
            DB::commit();
            $this->redirectTo('/user/role');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            $this->alert('error', $th->getMessage());
        }
    }

    public function redirectTo($path)
    {
        return redirect()->to($path);
    }

    public function addPermissionId($val)
    {
        $val = (int) $val;
        array_push($this->permission_id, $val);
    }
    public function removePermissionId($val)
    {
        $arr = $this->permission_id;
        $index = array_search($val, $arr);
        array_splice($this->permission_id, $index, 1);
    }
    public function removeAllFromId($listId)
    {
        $arr = $this->permission_id;

        foreach ($listId as $key => $val) {
            $index = array_search($val, $arr);
            if($index) {
                array_splice($this->permission_id, $index, 1);
            }
        }
    }

    public function changeAccess()
    {
        $this->emit('change-access', $this->accessMenu);
    }
}