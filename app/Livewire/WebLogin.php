<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\Tracer\Tracer;

class WebLogin extends Component
{

    #[Title('Masuk Ke Aplikasi Imagery')]

    #[Validate('required')]
    public $username = '';
    public $password = '';

    public $user;

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->to('/login');
    }

    public function login_act()
    {
        $this->user = User::where('username', $this->username)->first();
        if ($this->user && base64_decode(base64_decode($this->user->password)) == $this->password) {
            if($this->user->id_role !=3){
                session(['user_edit'=>True]);
            }else{
                session(['user_edit'=>False]);
            }
            Auth::login($this->user);
            return redirect()->to('/dashboard');

        } else {
            session()->flash('error', 'Username atau Password yang Anda masukkan salah.');
        }
    }

    public function render()
    {
        return view('livewire.web-login');
    }
}
