<?php

namespace App\Livewire;

use App\Models\data_materi_detail;
use App\Models\data_tugas;
use App\Models\User;
use App\Models\bidang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WebTugasList extends Component
{
    public $id;
    public $md;
    public $author;
    public $dtugas;
    public $duser;
    public $dmd;
    public $dbidang = [];

    public function keDetail($a,$b,$c){
        $temp = base64_encode("dt>>".$a.">>".$b.">>".$c);
        return redirect("/materi/detail/".$this->id."/tugas/" . $temp);
    }

    public function mount(){
        $this->md = data_materi_detail::where('id_materi',$this->id)->join('data_materis','data_materi_details.id_materi','=','data_materis.id')
        ->select('data_materi_details.*','data_materis.id_authors','data_materis.judul')
        ->get()->first();

        $this->author = $this->md->id_authors;

        if(Auth::user()->id_role != 1 || Auth::user()->id != $this->author){
            $this->keDetail(Auth::user()->id,$this->md->id,0);
        }

        $this->dtugas = data_tugas::where('id_materi_detail',$this->md->id)
                        ->join('users','data_tugas.id_user','=','users.id')
                        ->select('data_tugas.*','users.nama','users.id_bidang')
                        ->get();

        foreach($this->dtugas as $dt){
            $finder = bidang::where('id',$dt->id_bidang)->get()->first();
            array_push($this->dbidang,$finder->bidang);
        }
    }

    public function render()
    {
        return view('livewire.web-tugas-list');
    }
}
