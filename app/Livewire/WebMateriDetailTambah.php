<?php

namespace App\Livewire;

use App\Models\data_materi_detail;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebMateriDetailTambah extends Component
{
    use WithFileUploads;

    public $id;
    public $detail_judul, $detail_deskripsi, $detail_isi, $detail_file;

    public $tipe_pilih = '';
    public $tipe_list = [
        'video',
        'audio',
        'gambar',
        'teks',
        'file'
    ];

    public $tipe_default = 3;

    public function tambahMateri(){
        $isian = "";
        if($this->tipe_pilih != $this->tipe_list[$this->tipe_default]){
            $nama_file = $this->detail_file->getClientOriginalName();
            $this->detail_file->storeAs(path: $this->tipe_pilih, name:$nama_file, options:'uploads');
            $isian = config('app.url') . "/storage//".$this->tipe_pilih."/" . $nama_file;
        }else{
            $isian = $this->detail_isi;
        }

        $md = new data_materi_detail();
        $md->judul = $this->detail_judul;
        $md->deskripsi = $this->detail_deskripsi;
        $md->tipe = $this->tipe_pilih;
        $md->isi = $isian;
        $md->id_materi = $this->id;
        $md->save();
        return redirect("/materi/detail/".$this->id);
    }

    public function mount(){
        $this->tipe_pilih = session('tipe_dipilih',$this->tipe_list[$this->tipe_default]);
    }

    public function render()
    {
        return view('livewire.web-materi-detail-tambah');
    }
}
