<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebAkun extends Component
{
    use WithFileUploads;
    public $nama, $tanggal_lahir, $jenis_kelamin,$password, $password_lama, $password_baru, $password_konfirmasi,$foto,$file;

    public function mount(){
        $this->nama = Auth::user()->nama;
        $this->tanggal_lahir = Auth::user()->tanggal_lahir;
        $this->jenis_kelamin = Auth::user()->jenis_kelamin;
        $this->password = Auth::user()->password;
        $this->foto = Auth::user()->foto;
    }

    public function updateFoto(){
        if($this->file){

        }
    }

    public function updateProfil(){
        $u = User::where('id',Auth::user()->id)->get()->first();
        if($u){
            $u->nama = $this->nama;
            $u->tanggal_lahir = $this->tanggal_lahir;
            $u->jenis_kelamin = $this->jenis_kelamin;
            $u->save();
            return redirect('/pengaturan-akun');
        }
    }

    public function updatePassword(){
        if($this->password_lama == base64_decode(base64_decode($this->password))){
            if($this->password_baru == $this->password_konfirmasi){
                $u = User::where('id',Auth::user()->id)->get()->first();
                if($u){
                    $u->password = base64_encode(base64_encode($this->password_konfirmasi));
                    $u->save();
                }
            }else{

            }
        }else{

        }
    }

    public function render()
    {
        return view('livewire.web-akun');
    }
}
