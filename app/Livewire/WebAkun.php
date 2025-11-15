<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WebAkun extends Component
{
    public $nama, $tanggal_lahir, $jenis_kelamin, $password;

    public function mount(){
        $this->nama = Auth::user()->nama;
        $this->tanggal_lahir = Auth::user()->tanggal_lahir;
        $this->jenis_kelamin = Auth::user()->jenis_kelamin;
        $this->password = Auth::user()->password;
    }

    public function render()
    {
        return view('livewire.web-akun');
    }
}
