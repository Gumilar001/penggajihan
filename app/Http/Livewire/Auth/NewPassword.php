<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NewPassword extends Component
{
    use LivewireAlert;
    public $postData = [
        'password' => '',
        'password_confirmation' => ''
    ];

    protected $rules = [
        'postData.password' => 'required',
        'postData.password_confirmation' => 'required',
    ];
    protected $messages = [
        'postData.password.required' => 'Password tidak boleh kosong',
        'postData.password_confirmation.required' => 'Konfirmasi Password tidak boleh kosong',
    ];

    public function render()
    {
        return view('livewire.auth.new-password');
    }

    public $token;

    public function mount()
    {
        $this->token = request()->token;
    }

    public function store()
    {
        $this->validate();
        if (($this->postData['password'] != "" && $this->postData['password_confirmation'] != "") && ($this->postData['password'] == $this->postData['password_confirmation'])) {
            $token = $this->token;

            \DB::beginTransaction();
            try {
                $email = \DB::table('password_resets')->where('token', $token)->first()->email;

                $user = User::where('email', $email)->first();
                $user->update([
                    'password' => bcrypt($this->postData['password_confirmation'])
                ]);

                \DB::table('password_resets')->where('email', $email)->delete();
                $this->alert('success', 'Berhasil reset password');
                \DB::commit();

                return redirect()->to('/login');
            } catch (\Throwable $th) {
                \DB::rollBack();
                $this->alert('error', $th->getMessage());
            }

        } else {
            $this->alert('warning', "Konfirmasi Password tidak sesuai");
        }


    }
}