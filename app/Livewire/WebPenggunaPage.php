<?php

namespace App\Livewire;

use Livewire\Component;

use App\Http\Controllers\api_support;
use App\Models\bidang;
use App\Models\role;
use App\Models\User;

class WebPenggunaPage extends Component
{
    public $data;
    public $title_list = ["Tambah Pengguna","Edit Pengguna "];
    public $title="";
    public $status = 0;
    public $user_id,$username, $nama, $tanggal_lahir, $jenis_kelamin, $foto, $password, $cpass, $id_role, $id_bidang;
    public $d_role;
    public $d_bidang;

    public function mount(){
        $as = new api_support;
        $arr = $as->deco($this->data);

        $this->d_bidang = bidang::all();
        $this->d_role = role::all();

        if($arr[0]=="user" && $arr[1]==1){
            $userc = User::find($arr[2]);
            if($userc){
                $this->user_id = $userc->id;
                $this->username = $userc->username;
                $this->nama = $userc->nama;
                $this->tanggal_lahir = $userc->tanggal_lahir;
                $this->jenis_kelamin = $userc->jenis_kelamin;
                $this->foto = $userc->foto;
                $this->id_role = $userc->id_role;
                $this->id_bidang = $userc->id_bidang;
                $this->password = base64_decode(base64_decode($userc->password));
                $this->status = $arr[1];
            }
        }
        $this->title = $this->title_list[$arr[1]];
    }

    public function simpanData(){
        if($this->status == 0){
            $u = new User();
            $u->username = $this->username;
            $u->nama = $this->nama;
            $u->tanggal_lahir = $this->tanggal_lahir;
            $u->jenis_kelamin = $this->jenis_kelamin;
            $u->id_role = $this->id_role;
            $u->id_bidang = $this->id_bidang;
            $u->password = base64_encode(base64_encode($this->password));
            $u->save();
        }else{
            $u = User::find($this->user_id);
            $u->username = $this->username;
            $u->nama = $this->nama;
            $u->tanggal_lahir = $this->tanggal_lahir;
            $u->jenis_kelamin = $this->jenis_kelamin;
            $u->id_role = $this->id_role;
            $u->id_bidang = $this->id_bidang;
            $u->password = base64_encode(base64_encode($this->password));
            $u->save();
        }
        $this->kembali();
    }

    public function kembali(){
        return redirect("pengguna");
    }

    public function render()
    {
        return view('livewire.web-pengguna-page');
    }
}
