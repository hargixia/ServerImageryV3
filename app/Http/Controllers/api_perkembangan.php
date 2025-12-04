<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api_support;
use App\Models\data_kategori;
use App\Models\data_kuisoner;
use App\Models\data_materi_detail;
use App\Models\User;

class api_perkembangan extends Controller
{
    # code, msg, res
    public $vg = [0,"No Auth",[]];

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
        return json_encode(array($data));
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

    public function perkembangan_user($data){
        $as = new api_support();

        $data = $as->deco($data);
        if($data[0]=="pu"){
            $md     = data_materi_detail::where('id_materi',$data[2])->get()->first();
            $user   = User::where('id',$data[1])->get()->first();


            if($md && $user){

                $kd     = data_kuisoner::where('id_materi',$data[2])->where('id_user',$user->id)->orderBy('created_at','asc')->get();
                $tertinggi = data_kuisoner::where('id_materi',$data[2])->orderBy('nilai','desc')->get()->first();
                $utertinggi = User::where('id',$tertinggi->id_user)->get()->first();
                $tmax   = data_kuisoner::where('id_materi',$data[2])->where('id_user',$user->id)->orderBy('nilai','desc')->get()->first();
                $tmin   = data_kuisoner::where('id_materi',$data[2])->where('id_user',$user->id)->orderBy('nilai','asc')->get()->first();

                $kd_sum = 0;

                foreach($kd as $i){
                    $kd_sum += $i->nilai;
                }

                $avg = $kd_sum/count($kd);

                $dayMapping = [
                    "Sunday"    => "Minggu",
                    "Monday"    => "Senin",
                    "Tuesday"   => "Selasa",
                    "Wednesday" => "Rabu",
                    "Thursday"  => "Kamis",
                    "Friday"    => "Jumat",
                    "Saturday"  => "Sabtu",
                ];

                $kat = "";
                $kategori = data_kategori::all();
                foreach($kategori as $k){
                    if($avg >= $k->minimal && $avg <= $k->maksimal){
                        $kat = $k->kategori;
                        break;
                    }
                }

                $kdn = array();
                foreach($kd as $i => $k){
                    array_push($kdn,[
                        'no'        => $i+1,
                        'nilai'     => $k->nilai,
                        'kategori'  => $k->kategori,
                        'tipe'      => $k->tipe,
                        'hari'      => $dayMapping[date('l', strtotime($k->created_at))],
                        'tanggal'   => date('d-m-Y',strtotime($k->created_at))
                    ]);
                }

                $da = data_kuisoner::where('id_materi',$data[2])->where('id_user',$data[1])->orderBy('created_at','desc')->get();
                if(count($kd) >= 11){
                    $da = data_kuisoner::where('id_materi',$data[2])->where('id_user',$data[1])->orderBy('created_at','desc')->take(10)->get();
                }

                $temp = [];
                $list_kesimpulan = ['Turun','Stabil','Naik'];
                $kesimpulan = "Belum Terlihat Perkembangannya";
                $index = 0;
                if(count($da) >=2 ){
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
                    $index = $n/$c;
                    $kesimpulan = $list_kesimpulan[$index + 1];
                }

                $res = array();
                $tgl_lahir = date_create($user->tanggal_lahir);
                $sekarang = date_create();
                $umur = date_diff($tgl_lahir,$sekarang)->y;
                array_push($res,[
                    'judul'     => $md->judul,
                    'nama'      => $user->nama,
                    'umur'      => $umur,
                    'gender'    => $user->jenis_kelamin,
                    't_jumlah'  => count($kd),
                    't_max'     => $tmax->nilai,
                    't_min'     => $tmin->nilai,
                    'last_h'    => $dayMapping[date('l', strtotime($tmax->created_at))],
                    'last_w'    => date('d-m-Y',strtotime($tmax->created_at)),
                    't_avg'     => number_format($avg,2),
                    'kategori'  => $kat,
                    'status'    => $kesimpulan,
                    'tinggi'    => $tertinggi->nilai,
                    'utinggi'   => $utertinggi->nama,
                    'data'      => $kdn
                ]);
                $this->vg[0] = 200;
                $this->vg[1] = "Data Perkembangan " . $user->nama;
                $this->vg[2] = $res;
            }else{
                $this->vg[0] = 404;
                $this->vg[1] = "Data Materi atau User Tidak Ditemukan";
                $this->vg[2] = [];
            }
        }
        return $this->retuner($this->vg[0],$this->vg[1],$this->vg[2]);
    }
}
