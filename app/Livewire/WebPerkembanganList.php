<?php

namespace App\Livewire;

use App\Models\data_kuisoner;
use App\Models\data_kategori;
use App\Models\data_materi;
use App\Models\User;
use App\Models\bidang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

class WebPerkembanganList extends Component
{
    /*
    Tambahkan informasi untuk didalam list perkembangan
    1. Nama User
    2. Total Soal yang telah dikerjakan
    3. Rata-rata Nilai
    4. Performa dari user 10 pengerjaan terakhir
    Rumus nya adalah di ambil data 10 pengerjaan terakhir,
    lalu dihitung setiap selisih dari nilai sebelumnya, jika naik maka +1, jika turun -1,
    jika sama 0
    lalu di jumlahkan, jika hasilnya positif maka performa naik,
    jika negatif maka performa turun, jika 0 maka stabil
    */
    #[Title('Daftar Perkembangan')]

    public $id;
    public $materi;
    public $listUser =[];
    public $idu;

    public $data_kuisoner;
    public $umur;
    public $bidang;

    public $user;
    public $user_bidang;
    public $rata_nilai = 0;
    public $rata_kategori;

    public function tampilkan($id){
        return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.$id);
    }

    public function mount(){
        $this->materi = data_materi::where('id',$this->id)->get()->first();
        if($this->materi->id_authors != Auth::user()->id){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }

        $user = User::all();
        foreach($user as $u){
            $finder = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->get()->first();
            if($finder){
                array_push($this->listUser,$u);
            }
        }

    }

    public function render()
    {
        return view('livewire.web-perkembangan-list');
    }
}
