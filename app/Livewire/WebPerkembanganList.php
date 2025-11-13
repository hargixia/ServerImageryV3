<?php

namespace App\Livewire;

use App\Models\data_kuisoner;
use App\Models\data_kategori;
use App\Models\data_materi;
use App\Models\User;
use App\Models\bidang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

class WebPerkembanganList extends Component
{

    #[Title('Daftar Perkembangan')]

    public $id;
    public $materi;
    public $listUser =[];
    public $idu;

    public $data_kuisoner;
    public $umur;
    public $bidang;

    public $user;
    public $user_bidang;
    public $rata_nilai = 0;
    public $rata_kategori;

    public function tampilkan($id){
        return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.$id);
    }

    public function mount(){
        $this->materi = data_materi::where('id',$this->id)->get()->first();
        if($this->materi->id_authors != Auth::user()->id){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }

        $user = User::all();
        foreach($user as $u){
            $finder = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->get()->first();
            if($finder){
                array_push($this->listUser,$u);
            }
        }

    }

    public function render()
    {
        return view('livewire.web-perkembangan-list');
    }
}
