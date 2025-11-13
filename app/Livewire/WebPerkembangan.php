<?php

namespace App\Livewire;

use App\Models\data_kuisoner;
use App\Models\data_materi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WebPerkembangan extends Component
{
    public $id;
    public $idu;

    public $materi;
    public $data_kuisoner;
    public $umur;

    public function mount(){
        $this->materi = data_materi::find($this->id);
        $author = $this->materi->id_authors;
        if(Auth::user()->id_role == 1 || Auth::user()->id == $author){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }
        $this->data_kuisoner = data_kuisoner::where('id_user', $this->idu)->where('id_materi',$this->id)->get();
        $tgl_lahir = date_create(Auth::user()->tanggal_lahir);
        $sekarang = date_create();
        $this->umur = date_diff($tgl_lahir,$sekarang)->y;
    }

    public function render()
    {
        return view('livewire.web-perkembangan');
    }
}
