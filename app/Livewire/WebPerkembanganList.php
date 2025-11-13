<?php

namespace App\Livewire;

use App\Models\data_materi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WebPerkembanganList extends Component
{
    public $id;
    public $materi;

    public function mount(){
        $this->materi = data_materi::where('id',$this->id)->get()->first();
        if($this->materi->id_authors != Auth::user()->id){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }
    }

    public function render()
    {
        return view('livewire.web-perkembangan-list');
    }
}
