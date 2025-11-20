<?php

namespace App\Livewire;

use App\Models\data_materi_detail;
use App\Models\data_tugas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class WebTugas extends Component
{

    #[Title('Kerjakan Tugas')]

    public $id, $idu, $idmd, $data;
    public $materi_detail;
    public $tugas = array();
    public $dtugas;
    public $t_isi, $status, $file, $nilai;
    public $ctime, $md_s;
    public $kirim = 0;
    public $ss = "Belum Dinilai";


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
        if($this->kirim == 4){
            return redirect('/materi/detail/'.$this->id.'/tugas');
        }else{
            return redirect('/materi/detail/'.$this->id);
        }
    }

    public function mount(){

        $temp = base64_decode($this->data);
        $arr = explode('>>',$temp);
        $this->idu = $arr[1];
        $this->idmd = $arr[2];
        $this->kirim = $arr[3];

        $this->dtugas = data_tugas::where('id_user',$this->idu)
                        ->join('users','data_tugas.id_user','=','users.id')
                        ->select('data_tugas.*','users.nama')
                        ->get()->first();
        $this->materi_detail = data_materi_detail::where('id',$this->idmd)->get()->first();
        $temp = [
            $this->materi_detail->isi_tugas,
            $this->materi_detail->exp,
            $this->materi_detail->start,
            $this->materi_detail->stop,
        ];

        array_push($this->tugas,$temp);
        if($this->dtugas){
            $this->t_isi = $this->dtugas->isi;
            $this->status = $this->dtugas->status;
            $this->nilai = $this->dtugas->nilai;
        }else{
            $this->ss = "Anda Tidak Membuat Tugas";
        }

        $tgl_expired = Carbon::parse($this->materi_detail->stop);


        if($this->t_isi == ""){
            $this->kirim = 0;
        }else{
            $this->kirim = 3;
        }

        if($tgl_expired->isPast()){
            $this->kirim = 3;
        }

        if($arr[3]==4){
            $this->kirim = 4;
        }

        if($this->materi_detail->exp == 0){
            $this->cek_time($this->materi_detail->start,$this->materi_detail->stop);
        }else{
            $this->kembali();
        }
    }

    public function kirimTugas(){
        if($this->kirim == 3){
            $this->dtugas->isi = $this->t_isi;
            $this->dtugas->status = true;
            $this->dtugas->updated_at = date("Y-m-d H:i:s");
            $this->dtugas->save();
        }else{
            $tgs = new data_tugas();
            $tgs->isi = $this->t_isi;
            $tgs->status = False;
            $tgs->nilai = 0;
            $tgs->id_materi_detail = $this->id;
            $tgs->id_user = Auth::user()->id;
            $tgs->save();
        }
        $this->kembali();
    }

    public function beriNilai(){
        $this->dtugas->nilai = $this->nilai;
        $this->dtugas->status = true;
        $this->dtugas->updated_at = date("Y-m-d H:i:s");
        $this->dtugas->save();
        return redirect("http://localhost:8000/materi/detail/".$this->id."/tugas/".$this->data);
    }

    public function render()
    {
        return view('livewire.web-tugas');
    }
}
