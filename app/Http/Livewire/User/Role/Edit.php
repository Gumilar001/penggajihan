<?php

namespace App\Http\Livewire\User\Role;

use App\Models\MasterPermission;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;

class Edit extends Component
{

    use LivewireAlert;

    public $idEdit;
    public $accessMenu = '';
    public $listPermissions = [];
    public $postData = [
        'role_name' => null,
    ];

    public $role_name, $is_active = true, $permission_id = [];

    protected $listeners = ['addPermissionId', 'removePermissionId', 'removeAllFromId', 'setAccess'];

    protected function rules()
    {
        return [
            'postData.role_name' => 'required|unique:roles,name,' . $this->idEdit,
            'accessMenu' => 'required',
        ];
    }

    protected $messages = [
        'postData.role_name.required' => 'Nama Role tidak boleh kosong',
        'postData.role_name.unique' => 'Nama Role sudah digunakan',
        'accessMenu' => 'Pilih Akses',
    ];


    public function render()
    {
        return view('livewire.user.role.edit');
    }

    public function mount()
    {
        $this->idEdit = request()->id;
        $this->getListPermission();
        $this->getData();
    }

    public function setStatus($value)
    {
        $this->is_active = $value;
    }

    public function setAccess($value)
    {
        $this->accessMenu = $value;
    }

    public function getData()
    {
        $role = Role::with('permissions')->find($this->idEdit);

        $this->postData['role_name'] = $role->name;
        $this->is_active = $role->is_active;

        if ($role->permissions) {
            $id = [];
            foreach ($role->permissions as $key => $permission) {
                $this->addPermissionId($permission->id);
                array_push($id, $permission->id);
            }
        }
    }

    public function getListPermission()
    {
        $this->listPermissions = MasterPermission::with('permission')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function store()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->validate();
        DB::beginTransaction();
        try {
            $data = [
                'name' => $this->postData['role_name'],
                'is_active' => $this->is_active
            ];

            $id = $this->idEdit;

            $role = Role::find($id);
            $permission_role = $role->permissions->pluck('id');

            foreach ($this->permission_id as $permission) {
                if (!in_array($permission, $permission_role->toArray())) {
                    $cek = Permission::find($permission);
                    if ($cek) {
                        $role->givePermissionTo($cek);
                    }
                }
            }

            $cek_delete_permission = $permission_role->diff($this->permission_id)->all();
            foreach ($cek_delete_permission as $delete) {
                $role->revokePermissionTo(Permission::find($delete));
            }

            $role = Role::find($id)->update($data);

            $this->alert('success', 'Data berhasil diubah');
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
            if ($index) {
                array_splice($this->permission_id, $index, 1);
            }
        }
    }

    public function changeAccess()
    {
        $this->permission_id = [];
        $this->emit('change-access', $this->accessMenu);
    }
}