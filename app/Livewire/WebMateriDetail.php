<?php

namespace App\Livewire;

use App\Models\data_app;
use App\Models\data_materi;
use App\Models\bidang;
use App\Models\data_materi_detail;
use Livewire\Component;

use App\Http\Controllers\api_kuisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

class WebMateriDetail extends Component
{
    #[Title('Detail Materi')]

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
    public $ctime;
    public $md_ts = array();
    public $md_te = array();
    public $md_exp = array();

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

        $this->ctime = date('Y-m-d H:i:s');

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

        $this->m_detail = data_materi_detail::where('id_materi',$this->id)->get();
        $sesion = session('user_edit', false);
        $author = $materi->id_authors;
        if(Auth::user()->id_role == 1 || Auth::user()->id == $author){
            $this->user_edit = true;
        }else{
            $this->user_edit = false;
        }

        foreach($this->m_detail as $md){
            $oritime_s = strtotime($md->start);
            array_push($this->md_ts,date("Y-m-d H:i:s",$oritime_s));

            $oritime_e = strtotime($md->stop);
            array_push($this->md_te,date("Y-m-d H:i:s",$oritime_e));


            array_push($this->md_exp,$md->exp);
        }

        if($kc->msg == $this->mode && $this->user_edit == false){
            $this->lakukanTest();
        }else{
            $this->mode = "PostTest";
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
        return redirect("/materi/detail/".$this->id);
    }

    public function materiTampil($idmd){
        if($idmd != ""){
            return redirect('/materi/detail/'.$this->id.'/tampil/'.$idmd);
        }
    }

    public function lakukanTest(){
        return redirect('/materi/'.$this->id.'/t/'.$this->mode);
    }

    public function kerjakanTugas($idmd){
        return redirect('/materi/detail/'.$this->id.'/tugas');
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
