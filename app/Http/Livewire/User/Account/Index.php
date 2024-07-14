<?php

namespace App\Http\Livewire\User\Account;

use App\Imports\UsersImportPangkat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Http\Services\{
    UserService,
    RoleService
};
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;


use Excel;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithFileUploads;
    public $data;
    public $typeModalActionAccount = 'add';
    public $isShowPassword = false;
    // public $password;
    // public $username;
    public $is_active = true;
    public $roles = [];
    public $search;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ["search"];
    public $fileUpload;
    public $progressUpload = 0;
    protected $listeners = ['selectTab', 'getRole', 'setPostRole', 'confirmedDelete'];

    public $filters = [
        'status' => '',
    ];

    public $postData = [
        'id' => null,
        'name' => null,
        'username' => null,
        'password' => null,
        'password_confirmation' => null,
        'role_id' => null,
    ];

    protected $rules = [
        'postData.name' => 'required',
        'postData.username' => 'required',
        'postData.role_id' => 'required',
        'postData.password' => 'required_if:typeModalActionAccount,"add"|min:6',
        'postData.password_confirmation' => 'required_if:typeModalActionAccount,"add"|min:6',
    ];

    protected $messages = [
        'postData.name.required' => 'Nama tidak boleh kosong',
        'postData.role_id.required' => 'Role tidak boleh kosong',
        'postData.username.unique' => 'Username sudah terpakai.',
        'postData.username.required' => 'Username tidak boleh kosong.',
        'postData.username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        'postData.password.required_if' => 'Password tidak boleh kosong.',
        'postData.password.min' => 'Password harus minimal 6 karakter.',
        'postData.password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        'postData.password_confirmation.required_if' => 'Password Konfirmasi tidak boleh kosong.',
    ];
    public function selectTab($value)
    {
        $this->selectedTab = $value;
    }

    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'name' => null,
            'username' => null,
            'password' => null,
            'password_confirmation' => null,
            'company_id' => null,
            'is_active' => 1,
        ];
    }
    public function toggleShowPassword()
    {
        $this->isShowPassword = !$this->isShowPassword;
        $this->emit('toggle-password', $this->isShowPassword);
    }
    public function render()
    {
        $searchValue = $this->search;
        $user = User::orderBy('id');

        if ($searchValue) {
            $user = $user->where(function ($user) use ($searchValue) {
                $user->Where('users.name', 'like', '%' . $searchValue . '%');
            });
        }

        $user = $user->paginate(10);

        return view('livewire.user.account.index', compact('user'));
    }
    public function getRole()
    {
        $roles = new RoleService();
        $this->roles = $roles->optionsRole();
    }
    public function mount()
    {
        $this->getRole();
    }
    public function setPostRole($field, $val)
    {
        $this->postData[$field] = $val;
    }
   
    public function deleteAccount($id)
    {
        $this->postData['id'] = $id;
        $this->alert('warning', 'Apakah Anda yakin akan menghapus User?', [
            'toast' => false,
            'text' => 'User yang dihapus tidak bisa dikembalikan kembali',
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Hapus',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'confirmedDelete',
            'timer' => null,
            'confirmButtonColor' => '#E12120',
            'cancelButtonColor' => '#6e7881',
            'allowOutsideClick' => false,
            'customClass' => [
                'confirmButton' => 'shadow-none',
                'cancelButton' => 'shadow-none',
            ]
        ]);
    }
    public function confirmedDelete()
    {
        User::find($this->postData['id'])
            ->delete();
        $this->clearPost();
        $this->alert('success', 'Data User berhasil dihapus');
    }
    public function showModal($type="add", $id=null)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->typeModalActionAccount = $type;
        try {
            if($type == 'edit'){
                $edit = User::find($id);
                $this->postData = [
                    'id' => $edit->id,
                    'name' => $edit->name,
                    'username' => $edit->username,
                    'role_id' => $edit->role_id,
                ];
            }else{
                $this->postData = [
                    'id' => null,
                    'name' => null,
                    'username' => null,
                    'password' => null,
                    'password_confirmation' => null,
                    'role_id' => null
                ];
            }
    
            $this->emit('show-modal');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
        
    }
    public function store() {
        $this->validate();
        try {
            if (!$this->postData['password']) {
                unset($this->rules['postData.password']);
                unset($this->rules['postData.password_confirmation']);
            } else {
                $this->postData['password'] = bcrypt($this->postData['password']);
            }
        } catch (\Throwable $th) {

        }

        if($this->typeModalActionAccount == 'add') {
            $user = User::create($this->postData);
            $role_id = (int) $this->postData['role_id'];
            if (isset($role_id))
                $user->assignRole($role_id);
        }else {
            try {
                $id = $this->postData['id'];
            $tes = User::find($id)->update($this->postData);

            $updateUser = User::find($this->postData['id']);

            $role_id = $this->postData['role_id'];
            $role = Role::where('id', '=', $role_id)->first();
            $role_name = null;

            if ($role) {
                $role_name = $role->id;
            }

            if (isset($role_name)) {
                $updateUser->roles()->sync([$role_name]);
            }
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }
            
        }
        
        $this->emit('close-modal-action-account');
        $this->alert('success', 'Data Berhasil Disimpan');
    }
    public function importPangkat() {
        $this->emit('show-modal-import');
    }
    public function removeFileUpload()
    {
        $this->fileUpload = null;
        $this->progressUpload = 0;
        $this->emit('remove-file-upload');
    }
    public function downloadTemplateImport()
    {
        return \Storage::disk('imports')->download('example_pangkat.xlsx');
    }
    public function import()
    {
        $validatedData = $this->validate(
            ['fileUpload' => 'required|max:50000|mimes:xlsx,xls'],
            [
                'fileUpload.required' => 'Pilih File terlebih dahulu.',
                'fileUpload.mimes' => 'File tidak sesuai',
            ],
        );

        try {


            $file = $this->fileUpload;
            Excel::import(new UsersImportPangkat, $file);

            $this->emit('done-import-pangkat');
            $this->alert('success', 'Berhasil Import Pangkat');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
}