<?php

namespace App\Livewire;

use App\Models\data_app;
use App\Models\data_materi;
use App\Models\data_materi_detail;
use App\Models\data_rekomendasi;
use App\Models\kuisoner_pertanyaan;
use Livewire\Component;

class WebKuisonerTambah extends Component
{
    public $id;
    public $idm;
    public $md;
    public $reko_d = array();
    public $jawaban;
    public $pertanyaan;

    public $nomor, $soal, $tipe;

    public $rekomendasi, $nilai;

    public $opsi_jawaban_1 = [
        'Setuju',
        'Netral',
        'Tidak Setuju',
    ];

    public $opsi_jawaban_2 = [
        'Sangat Setuju',
        'Setuju',
        'Netral',
        'Tidak Setuju',
        'Sangat Tidak Setuju',
    ];

    public $opsi_jawaban_dipakai;

    public function kembali(){
        return redirect("/materi/detail/".$this->id);
    }

    public function hapusPertanyaan($idp){
        data_rekomendasi::where('id_pertanyaan',$idp)->delete();
        kuisoner_pertanyaan::where('id',$idp)->delete();
    }

    public function tambahPertanyaan(){
        $np = new kuisoner_pertanyaan();
        $np->no = $this->nomor;
        $np->soal = $this->soal;
        $np->tipe = $this->tipe;
        $np->id_materi = $this->id;
        $np->save();

        $reko = new data_rekomendasi();
        $reko->nama = $this->rekomendasi;
        $reko->nilai = 0;
        $reko->id_pertanyaan = $np->id;
        $reko->save();

        return redirect()->to('/materi/detail/'.$this->id.'/kuisoner');
    }

    public function mount(){
        $this->idm = session('idm',1);
        $materi = data_materi::where('id',$this->id)->get()->first();
        $this->md = data_materi_detail::where('id',$this->idm)->get()->first();
        $apps = data_app::where('id',$materi->id_apps)->get()->first();
        $this->jawaban = $apps->jumlah_pertanyaan;
        $this->pertanyaan = kuisoner_pertanyaan::where('id_materi',$this->id)->orderBy('no','asc')->get();

        foreach($this->pertanyaan as $d){
            $rek = data_rekomendasi::where('id_pertanyaan',$d->id)->get()->first();
            array_push($this->reko_d,$rek->nama);
        }

        if($this->jawaban == 3){
            $this->opsi_jawaban_dipakai = $this->opsi_jawaban_1;
        }else{
            $this->opsi_jawaban_dipakai = $this->opsi_jawaban_2;
        }
    }

    public function render()
    {
        return view('livewire.web-kuisoner-tambah');
    }
}
