<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class ForgotPassword extends Component
{
    use LivewireAlert;
    public $email;
    protected $rules = [
        'email' => 'required|email'
    ];
    protected $messages = [
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Format Email tidak sesuai'
    ];

    protected $validationAttributes = [
        'email' => 'email address'
    ];

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }

    public function submit()
    {
        $this->validate();
        $email = $this->email;
        $check_email = User::whereEmail($email)->first();
        if (!$check_email) {
            $this->alert('warning', 'Email tidak terdaftar pada sistem');
        } else {
            \DB::beginTransaction();
            try {
                $token = Str::random(64);
                \DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()->timezone("asia/jakarta")->format("Y-m-d H:i:s")
                ]);

                \Mail::to($email)->send(new \App\Mail\ForgetPassword($token));
                $this->alert('success', 'Silahkan cek email anda');
                \DB::commit();
                $this->reset();
            } catch (\Throwable $th) {
                \DB::rollBack();
                $this->alert('error', $th->getMessage());
            }


        }
    }
}