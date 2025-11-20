<?php

namespace App\Http\Controllers;

use App\Models\data_app;
use App\Models\data_kuisoner;
use App\Models\kuisoner_pertanyaan;
use App\Models\kuisoner_jawab;
use App\Models\data_materi;
use App\Models\data_rekomendasi;
use App\Models\kuisoner_jawaban;

use App\Http\Controllers\api_support;
use App\Models\data_kategori;

class api_kuisoner extends Controller
{

    # code, msg, res
    public $vg = [0,"No Auth",[]];

    function deco($data){
        $decode = base64_decode($data);
        $arr = explode('>>',$decode);
        return $arr;
    }

    function splitterv2($data){
        $arr = explode('--',$data);
        return $arr;
    }

    function enco($data){
        $encode = base64_encode($data);
        return $encode;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function __construct()
    {
        $this->vg = [0,"No Auth",[]];
    }

    public function retuner($code,$msg,$res)
    {
        $data = [
            'code' => $code,
            'msg' => $msg,
            'res' => $res
        ];
        return json_encode($data);
    }


    public function kuisoner_pertanyaan($data){
        $data = $this->deco($data);
        if($data[0] == "kp"){
            if(true){
                $pertanyaan = kuisoner_pertanyaan::where('id_materi',$data[1])->get();
                $this->vg[0] = 1;
                $this->vg[1] = "Data Kuisoner Pertanyaan Ditemukan";
                $this->vg[2] = $pertanyaan;
            }else{
                $this->vg[0] = 0;
                $this->vg[1] = "Data Kuisoner Pertanyaan Tidak Ditemukan";
                $this->vg[2] = [];
            }
        }
        return $this->retuner($this->vg[0],$this->vg[1],$this->vg[2]);
    }

    public function kuisoner_cek($data){
        $data = $this->deco($data);
        if($data[0]=="kc"){
            $cek_pertanyaan = kuisoner_pertanyaan::where('id_materi',$data[1])->get()->first();
            $res = data_kuisoner::where('id_materi',$data[1])->where('id_user',$data[2])->orderBy('created_at','desc')->get();
            if($cek_pertanyaan){
                if(count($res)>0){
                    $this->vg[0] = 1;
                    $this->vg[1] = "PostTest";
                    $this->vg[2] = [];
                }else{
                    $this->vg[0] = 0;
                    $this->vg[1] = "PreTest";
                    $this->vg[2] = [];
                }
            }
        }
        return $this->retuner($this->vg[0],$this->vg[1],$this->vg[2]);
    }

    public function kuisoner_jawab($data){
        $as = new api_support();

        $data = $as->deco($data);
        $c_data = count($data);
        if($data[0] == "kj"){

            $idm = $data[1];
            $idu = $data[2];
            $jawaban = [];
            $nilai = 0;

            $cMateri = data_materi::where('id',$idm)->get()->first();
            $cApps = data_app::where('id',$cMateri->id_apps)->get()->first();

            for($i=4;$i<$c_data;$i++){
                $temp = $as->splitterv2($data[$i]);
                $temp_reko = data_rekomendasi::where('id_pertanyaan',$temp[0])->get()->first();
                $temp_tipe = kuisoner_pertanyaan::where('id',$temp[0])->get()->first();
                $cnilai = (int)$temp[1] + 1;
                if($temp_tipe->tipe == 'N'){
                    $cnilai = ($cApps->jumlah_pertanyaan+1) - $cnilai;
                }
                array_push($temp,$cnilai);
                array_push($temp,$temp_reko->nilai);
                array_push($temp,$temp_reko->nama);
                array_push($temp,$temp_tipe->tipe);
                array_push($jawaban,$temp);
            }
            $total = array_sum(array_column($jawaban,2));
            $n = count($jawaban);
            $total_maks = $n * $cApps->jumlah_pertanyaan;
            $nilai = number_format((($total / $total_maks) * 100),2);
            $rekomen = "";
            $mid = floatval($cApps->jumlah_pertanyaan / 2) + 1;
            foreach($jawaban as $i => $j){
                if($j[1] <= $mid){
                    $rekomen = $rekomen . $j[4];
                    if($i < ($n - 1)){
                        $rekomen = $rekomen . ", ";
                    }
                }
            }

            $kat = "";
            $kategori = data_kategori::all();
            foreach($kategori as $k){
                if($nilai >= $k->minimal && $nilai <= $k->maksimal){
                    $kat = $k->kategori;
                    break;
                }
            }

            $res = array();
            array_push($res,[
                'total_nilai'   => $total,
                'nilai'         => $nilai,
                'rekomendasi'   => $rekomen,
                'kategori'      => $kat
            ]);
            $posx = 0;
            $pos = kuisoner_jawaban::where('id_user',$idu)->where('id_materi',$idm)->orderBy('created_at','desc')->get()->first();
            if($pos == null){
                $posx = 0;
            }else{
                $posx = $pos->pos + 1;
            }

            foreach($jawaban as $j){
                $kj = new kuisoner_jawaban();
                $kj->id_materi = $idm;
                $kj->id_user = $idu;
                $kj->id_pertanyaan = $j[0];
                $kj->jawaban = $j[1];
                $kj->pos = $posx;
                $kj->rekomendasi = $j[4];
                $kj->save();
            }

            $kuisoner = new data_kuisoner();
            $kuisoner->id_materi = $idm;
            $kuisoner->id_user = $idu;
            $kuisoner->nilai = $nilai;
            $kuisoner->rekomendasi = $rekomen;
            $kuisoner->kategori = $kat;
            $kuisoner->tipe = $data[3];
            $kuisoner->save();

            $this->vg[0] = 0;
            $this->vg[1] = "Hasil Kuisoner";
            $this->vg[2] = $res;
            return $this->retuner($this->vg[0],$this->vg[1],$this->vg[2]);

            echo json_encode($jawaban);
        }
    }

}
