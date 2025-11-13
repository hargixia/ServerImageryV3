<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

use App\Models\User;
use App\Models\bidang;

class WebRegister extends Component
{

    #[Title('Daftar Akun Imagery')]

    #[Validate('required')]
    public $user;
    public $username = '';
    public $nama = '';
    public $tanggal_lahir = '';
    public $jenis_kelamin = '';
    public $password = '';
    public $cpassword = '';
    public $id_bidang = '';

    public $data_bidang;

    public function mount()
    {
        $this->data_bidang = bidang::all();
    }

    public function register_act()
    {
        if($this->password != $this->cpassword){
            session()->flash('error', 'Password dan Konfirmasi Password tidak sesuai.');
        } else {
            $this->user = User::where('username', $this->username)->exists();
            if($this->user){
                $this->addError('User','User telah Ada!');
            }else{
                $user = new User();
                $user->username = $this->username;
                $user->nama = $this->nama;
                $user->tanggal_lahir = $this->tanggal_lahir;
                $user->jenis_kelamin = $this->jenis_kelamin;
                $user->id_role = 3;
                $user->id_bidang = $this->id_bidang;
                $user->password = base64_encode(base64_encode($this->password));
                $user->save();
                session()->flash('success', 'Pendaftaran berhasil. Silahkan masuk menggunakan akun Anda.');
                return redirect()->to('/login');
            }

        }
    }

    public function render()
    {
        return view('livewire.web-register');
    }
}
