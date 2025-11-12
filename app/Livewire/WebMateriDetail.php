<?php

namespace App\Livewire;

use App\Models\data_app;
use App\Models\data_materi;
use App\Models\bidang;
use App\Models\data_materi_detail;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class WebMateriDetail extends Component
{
    public $id;
    public $idm;
    public $m_judul;
    public $m_deskripsi;
    public $m_app;
    public $m_bidang;

    public $user_edit = false;

    public $m_detail;

    public $tipe_pilih = '';
    public $tipe_list = [
        'video',
        'audio',
        'gambar',
        'teks',
        'file'
    ];

    public function mount($id){
        $this->user_edit = session('user_edit', false);

        $this->id = $id;
        $materi = data_materi::find($this->id);
        $app = data_app::find($materi->id_apps);
        $bidang = bidang::find($materi->id_bidangs);
        $this->idm = $materi->id;
        $this->m_judul = $materi->judul;
        $this->m_deskripsi = $materi->deskripsi;
        $this->m_app = $app;
        $this->m_bidang = $bidang;

        $this->m_detail = data_materi_detail::where('id_materi',$this->id)->get();
    }

    public function materiTampil($idmd){
        if($idmd != ""){
            return redirect('/materi/detail/'.$this->id.'/tampil/'.$idmd);
        }
    }

    public function tambahMateri($idm,$tipe){
        if($idm != "" || $tipe != ""){
            session(['tipe_dipilih'=>$this->tipe_list[$tipe]]);
            return redirect('/materi/detail/'.$idm.'/tambah');
        }
    }

    public function tambahKuisoner($idm){
        if($idm != null){
            session(['idm'=>$idm]);
            return redirect('/materi/detail/'.$this->id.'/kuisoner');
        }
    }

    public function render()
    {
        return view('livewire.web-materi-detail');
    }
}
