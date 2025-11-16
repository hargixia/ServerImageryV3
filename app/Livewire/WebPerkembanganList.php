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

    public $soal_dikerjakan = [];
    public $rata2nilai = [];
    public $performa = [];

    public function tampilkan($id){
        return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.$id);
    }

    public function banding($val1,$val2){
        $i = 0;
        if($val1 == $val2){
            $i = 0;
        }elseif($val1 < $val2){
            $i = -1;
        }else{
            $i = 1;
        }
        return $i;
    }

    public function mount(){
        $this->materi = data_materi::where('id',$this->id)->get()->first();
        if($this->materi->id_authors != Auth::user()->id){
            return redirect('/materi/detail/'.$this->id.'/perkembangan/d/'.Auth::user()->id);
        }

        $user = User::all();
        foreach($user as $index => $u){
            $finder = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->get()->first();
            if($finder){
                array_push($this->listUser,$u);
                $temp_total_dikerjakan = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->get();
                array_push($this->soal_dikerjakan, count($temp_total_dikerjakan));

                $nilai = 0;
                foreach($temp_total_dikerjakan as $t){
                    $nilai += $t->nilai;
                }

                $temp_rata2 = number_format($nilai / count($temp_total_dikerjakan),2);
                array_push($this->rata2nilai,$temp_rata2);

                $da = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->orderBy('created_at','desc')->get();
                if(count($da) >= 10){
                    $da = data_kuisoner::where('id_materi',$this->id)->where('id_user',$u->id)->orderBy('created_at','desc')->take(10)->get();
                }
                $temp = [];
                $kesimpulan = ['Turun','Stabil','Naik'];
                $n = 0;
                $c = 0;
                for($i = 0; $i < count($da);$i++){
                    if(($i+1) == count($da)){
                        break;
                    }
                    $a = $da[$i]->nilai;
                    $b = $da[$i+1]->nilai;
                    $ab = $this->banding($a,$b);
                    $n += $ab;
                    $c += 1;
                    array_push($temp,[$a,$b,$ab,$c]);
                }
                $sum = $n/$c;
                array_push($this->performa,$kesimpulan[$sum + 1]);
            }
        }

    }

    public function render()
    {
        return view('livewire.web-perkembangan-list');
    }
}
