<?php

namespace App\Http\Livewire\Setting;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    public $user = [
        'foto' => null,
        'name' => 'Admin',
        'role' => 'Admin Proyek',
    ];

    public $selectedTab = 0;

    public $postData = [
        'username' => '',
        'password' => '',
        'password_confirmation' => ''
    ];

    public $postDataProfile = [
        'name' => 'Admin',
        'username' => 'admin',
        'email' => '',
        'role' => 'Admin Proyek',
        'no_whatsapp' => ''
    ];

    protected $listeners = ['uploadFoto', 'getData', 'resetFoto'];

    public function render()
    {
        return view('livewire.setting.index');
    }

    public function mount()
    {
        $this->getDataUser();
        $this->getData();
    }

    public function getDataUser()
    {
        $name = Auth::user()->name;
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        $role = Auth::user()->roles->pluck('name')->toArray()[0]??'';
        $no_whatsapp = Auth::user()->no_whatsapp;

        $this->postDataProfile = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'no_whatsapp' => $no_whatsapp
        ];

    }

    public function getData()
    {
        $this->user = [
            'name' => Auth::user()->name,
            'role' => Auth::user()->roles->pluck('name')->toArray()[0]??'',
            'foto' => Auth::user()->photo
        ];
    }

    public function selectTab($val)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if ($val == 0) {
            $this->getDataUser();
        }

        $this->selectedTab = $val;
        $this->emit('select-tab', $val);
    }

    public function uploadFoto($result)
    {
        $this->user['foto'] = $result;
    }

    public function cancel()
    {
        if ($this->selectedTab == 0) { // Informasi Profile
            $this->getDataUser();
        } else { // Ubah Password
            $this->postData['password'] = '';
            $this->postData['password_confirmation'] = '';
        }
    }

    public function resetFoto()
    {
        if (isset($this->user['foto'])) {
            try {
                $this->postDataProfile['photo'] = null;
                $this->user['foto'] = null;

                $userService = new UserService();
                $id = Auth::user()->id;
                $userService->update(
                    $id,
                    [
                        'photo' => null
                    ]
                );
                $this->alert('success', 'Foto Berhasil Dihapus');
            } catch (\Throwable $th) {
                $this->alert('warning', 'Terjadi Kesalahan');
            }
        }

    }

    public function store()
    {
        $userService = new UserService();
        $id = Auth::user()->id;

        if ($this->selectedTab == 0) {
            $this->validate(
                [
                    'postDataProfile.name' => 'required',
                    'postDataProfile.username' => 'required',
                ],
                [
                    'postDataProfile.name.required' => 'Nama tidak boleh kosong',
                    'postDataProfile.username.required' => 'Username tidak boleh kosong',
                ]
            );
        } else {
            $this->validate(
                [
                    'postData.password' => 'required',
                    'postData.password_confirmation' => 'required',
                ],
                [
                    'postData.password.required' => 'Password tidak boleh kosong',
                    'postData.password_confirmation.required' => 'Konfirmasi Password tidak boleh kosong',
                ]
            );
        }

        try {
            if ($this->selectedTab == 0) { // Informasi Profile
                $this->postDataProfile['photo'] = $this->user['foto'];
                $userService->update($id, $this->postDataProfile);

                $this->alert('success', 'Data Berhasil Diperbarui');
                $this->getData();
                $this->user['name'] = $this->postDataProfile['name'];
                $this->user['foto'] = $this->postDataProfile['photo'];
                $this->emit('done-update-profile', $this->user['foto']);
            } else { // Ubah Password
                if (($this->postData['password'] != "" && $this->postData['password_confirmation'] != "") && ($this->postData['password'] == $this->postData['password_confirmation'])) {
                    $userService->update(
                        $id,
                        [
                            'password' => bcrypt($this->postData['password']),
                        ]
                    );
                    $this->alert('success', 'Data Berhasil Diperbarui');
                    $this->postData = [
                        'password' => '',
                        'password_confirmation' => ''
                    ];
                }
            }
        } catch (\Throwable $th) {
            $this->alert('warning', 'Terjadi Kesalahan');
        }
    }
}