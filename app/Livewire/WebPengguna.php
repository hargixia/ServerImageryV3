<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\bidang;
use App\Models\role;
use Livewire\Component;
use Livewire\Attributes\Title;

class WebPengguna extends Component
{

    #[Title('Daftar Pengguna')]

    public $data_bidang;
    public $pengguna;
    public $role;

    public $status = 0;

    // input tambah
    public $u_id;
    public $data = [];

    // hapus
    public $delete_id;

    public function mount(){
        $this->data_bidang = bidang::all();
        $this->role = role::all();
    }

    public function render()
    {
        $this->pengguna = User::join('bidangs','bidangs.id','=','id_bidang')->select('users.*','bidangs.bidang')->get();
        return view('livewire.web-pengguna');
    }

    public function parcel($mode,$data){
        $temp = base64_encode("user>>".$mode.">>".$data);
        return redirect("/pengguna/d/".$temp);
    }

    public function tambahUser(){
        $this->parcel("0","0");
    }

    // tampil data untuk edit
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        if($user){
            $this->parcel("1",$user->id);
        }
    }

    // hapus
    public function deleteUser($id)
    {
        $this->delete_id = $id;
    }

    public function confirmDelete()
    {
        $user = User::findOrFail($this->delete_id);
        $user->delete();

        session()->flash('message', 'Pengguna berhasil dihapus.');

    }

}
