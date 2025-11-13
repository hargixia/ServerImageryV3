<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

use App\Models\data_materi_detail;

class WebMateriDetailTampil extends Component
{

    #[Title('Tampil Materi Detail')]

    public $id, $idmd;
    public $materiNow;

    public function mount(){
        $this->materiNow = data_materi_detail::find($this->idmd)->get()->first();
    }

    public function render()
    {
        return view('livewire.web-materi-detail-tampil');
    }

    public function kembali(){
        return redirect('/materi/detail/'.$this->id);
    }
}
