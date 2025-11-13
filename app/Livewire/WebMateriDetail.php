<?php

namespace App\Livewire;

use App\Models\data_app;
use App\Models\data_materi;
use App\Models\bidang;
use App\Models\data_materi_detail;
use Livewire\Component;

use App\Http\Controllers\api_kuisoner;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class WebMateriDetail extends Component
{
    public $id;
    public $idm;
    public $m_judul;
    public $m_deskripsi;
    public $m_app;
    public $m_bidang;
    public $m_tugasBool;

    public $mode = "PreTest";
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

    public $cekKuisoner ="";

    public function mount($id){

        $this->id = $id;

        $ak = new api_kuisoner();
        $idu = Auth::user()->id;
        $data = "kc>>".$id.">>".$idu;
        $kc = json_decode($ak->kuisoner_cek(base64_encode($data)));

        $materi = data_materi::find($this->id);
        $app = data_app::find($materi->id_apps);
        $bidang = bidang::find($materi->id_bidangs);
        $this->idm = $materi->id;
        $this->m_judul = $materi->judul;
        $this->m_deskripsi = $materi->deskripsi;
        $this->m_app = $app;
        $this->m_bidang = $bidang;

        if($kc->msg == $this->mode){
            $this->lakukanTest();
        }else{
            $this->mode = "PostTest";
        }

        $this->m_detail = data_materi_detail::where('id_materi',$this->id)->get();
        $sesion = session('user_edit', false);
        $author = $materi->id_authors;
        if(Auth::user()->id_role == 1 || Auth::user()->id == $author){
            $this->user_edit = true;
        }else{
            $this->user_edit = false;
        }

    }

    public function kePerkembangan(){
        if($this->user_edit == false){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }else{
            return redirect('/materi/detail/'.$this->id.'/perkembangan');
        }
    }

    public function hapusMD($id){
        data_materi_detail::where('id', $id)->delete();
    }

    public function materiTampil($idmd){
        if($idmd != ""){
            return redirect('/materi/detail/'.$this->id.'/tampil/'.$idmd);
        }
    }

    public function lakukanTest(){
        return redirect('/materi/'.$this->id.'/t/'.$this->mode);
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
