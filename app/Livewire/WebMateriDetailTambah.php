<?php

namespace App\Livewire;

use App\Models\data_materi_detail;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


class WebMateriDetailTambah extends Component
{
    use WithFileUploads;

    #[Title('Tambah Detail')]
    public $id;
    public $detail_judul, $detail_deskripsi, $detail_isi, $detail_file;

    public $tugasStat = "";
    public $tugasBool = False;
    public $tugas_exp, $tugas_start_date, $tugas_start_time, $tugas_stop_date, $tugas_stop_time, $isi_tugas;
    public $start_combine, $stop_combine;


    public $tipe_pilih = '';
    public $tipe_list = [
        'video',
        'audio',
        'gambar',
        'teks',
        'file'
    ];

    public $tipe_default = 3;

    public function kembali(){
        return redirect("/materi/detail/".$this->id);
    }

    public function tambahMateri(){

        $md = new data_materi_detail();
        $today = date("Ymd-His");
        $isian = "";
        if($this->tipe_pilih != $this->tipe_list[$this->tipe_default]){
            $nama_file = $this->id . "_"  . Auth::user()->id . "_" . $this->tipe_pilih . "_" . $today . "." .$this->detail_file->getClientOriginalExtension();
            $md->filename = $nama_file;
            $this->detail_file->storeAs(path: $this->tipe_pilih, name:$nama_file, options:'uploads');
            $isian = config('app.url') . "/storage//".$this->tipe_pilih."/" . $nama_file;
        }else{
            $isian = $this->detail_isi;
        }

        $start_temp = strtotime($this->tugas_start_date . " " . $this->tugas_start_time);
        $stop_temp = strtotime($this->tugas_stop_date . " " . $this->tugas_stop_time);

        $this->start_combine = new DateTime();
        $this->stop_combine = new DateTime();
        $this->start_combine->setTimestamp($start_temp);
        $this->stop_combine->setTimestamp($stop_temp);


        $md->judul = $this->detail_judul;
        $md->deskripsi = $this->detail_deskripsi;
        $md->tipe = $this->tipe_pilih;
        $md->isi = $isian;
        $md->id_materi = $this->id;
        $md->tugas = $this->tugasBool;
        $md->isi_tugas = $this->isi_tugas;
        $md->exp = $this->tugas_exp;
        $md->start = $this->start_combine->format('Y-m-d H:i:s');
        $md->stop = $this->stop_combine->format('Y-m-d H:i:s');
        $md->save();
        return redirect("/materi/detail/".$this->id);
    }

    public function onTugas(){
        if($this->tugasStat == ""){
            $this->tugasStat = "Checked";
            $this->tugasBool = True;
            $this->tugas_exp = False;
        }else{
            $this->tugasStat = "";
            $this->tugasBool = False;
            $this->tugas_exp = True;
            $this->isi_tugas = "";
            $this->start_combine = "";
            $this->stop_combine = "";
        }
    }

    public function mount(){
        $this->tipe_pilih = session('tipe_dipilih',$this->tipe_list[$this->tipe_default]);
    }

    public function render()
    {
        return view('livewire.web-materi-detail-tambah');
    }
}
