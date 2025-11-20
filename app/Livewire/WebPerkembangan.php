<?php

namespace App\Livewire;

use App\Models\bidang;
use App\Models\data_kategori;
use App\Models\data_kuisoner;
use App\Models\data_materi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class WebPerkembangan extends Component
{
    #[Title('Perkembangan')]

    public $id;
    public $idu;

    public $materi;
    public $data_kuisoner;
    public $umur;
    public $bidang;

    public $user;
    public $user_bidang;
    public $rata_nilai = 0;
    public $rata_kategori;

    public $performa;

    public function mount(){
        $this->performa = session('performa_user','Tidak ada');
        $this->materi = data_materi::find($this->id);
        $author = $this->materi->id_authors;

        if(Auth::user()->id != 1 || Auth::user()->id != $author){
            if(Auth::user()->id != $this->idu){
                return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
            }
        }
        $this->data_kuisoner = data_kuisoner::where('id_user', $this->idu)->where('id_materi',$this->id)->get();
        $this->bidang = bidang::where('id',$this->materi->id_bidangs)->get()->first();

        $tgl_lahir = date_create(Auth::user()->tanggal_lahir);
        $sekarang = date_create();
        $this->umur = date_diff($tgl_lahir,$sekarang)->y;

        $this->user = User::where('id',$this->idu)->get()->first();
        $this->user_bidang = bidang::where('id',$this->user->id_bidang)->get()->first();

        foreach($this->data_kuisoner as $dk){
            $this->rata_nilai += $dk->nilai;
        }

        $this->rata_nilai = number_format($this->rata_nilai / count($this->data_kuisoner),2);

        $kategori = data_kategori::all();

        foreach($kategori as $k){
            if($this->rata_nilai >= $k->minimal && $this->rata_nilai <= $k->maksimal){
                $this->rata_kategori = $k->kategori;
                break;
            }
        }

    }

    public function kembali(){
        return redirect("/materi/detail/".$this->id);
    }

    public function render()
    {
        return view('livewire.web-perkembangan');
    }
}
