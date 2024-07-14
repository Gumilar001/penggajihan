<?php

namespace App\Http\Livewire\Auth;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Http\Request;
use Auth;


class Login extends Component
{
    use LivewireAlert;
    public $isShowPassword = false;
    public $username;
    public $password;
    public $isRemember = false;

    public $listeners = ['login'];

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    protected $messages = [
        'username.required' => 'Username tidak boleh kosong',
        'password.required' => 'Password tidak boleh kosong'
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function toggleShowPassword()
    {
        $this->isShowPassword = !$this->isShowPassword;
        $this->emit('toggle-password', $this->isShowPassword);
    }

    public function login(Request $request)
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember_me = $this->isRemember;


        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $remember_me)) {
            // $user = auth()->user();
            // return redirect()->route('home');
            if(Auth::user()->is_active == 0){
                $this->alert('warning', 'Silahkan Hubungi Admin', [
                    'position' => 'center',
                    'timer' => 1000,
                    'toast' => false,
                ]);
                $this->password = '';
                Auth::logout();
            }else{
                return redirect()->to('/');
            }

        }else {
            $this->alert('warning', 'Username atau Password Tidak Sesuai', [
                'position' => 'center',
                'timer' => 1000,
                'toast' => false,
            ]);
            $this->password = '';
        }
    }
}