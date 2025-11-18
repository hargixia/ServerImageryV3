<?php

namespace App\Livewire;

use App\Models\data_materi_detail;
use App\Models\data_tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WebTugas extends Component
{

    public $id, $idmd;
    public $materi_detail;
    public $tugas = array();
    public $t_isi, $status, $file;
    public $ctime, $md_s;

    public function cek_time($time_val1,$time_val2){
        $this->ctime = date('Y-m-d H:i:s');
        $time1 = $time_val1;
        $time2 =$time_val2;
        $this->md_s = $time1;

        if($this->ctime < $time1 && $this->ctime > $time2){
            $this->kembali();
        }
    }

    public function kembali(){
        return redirect('/materi/detail/'.$this->id);
    }

    public function mount(){
        $this->materi_detail = data_materi_detail::where('id',$this->idmd)->get()->first();
        $temp = [
            $this->materi_detail->isi_tugas,
            $this->materi_detail->exp,
            $this->materi_detail->start,
            $this->materi_detail->stop,
        ];

        array_push($this->tugas,$temp);
        if($this->materi_detail->exp == 0){
            $this->cek_time($this->materi_detail->start,$this->materi_detail->stop);
        }else{
            $this->kembali();
        }
    }

    public function kirimTugas(){
        $tgs = new data_tugas();
        $tgs->isi = $this->t_isi;
        $tgs->status = true;
        $tgs->nilai = 0;
        $tgs->id_materi = $this->id;
        $tgs->id_user = Auth::user()->id;
        $tgs->save();
        $this->kembali();
    }

    public function render()
    {
        return view('livewire.web-tugas');
    }
}
