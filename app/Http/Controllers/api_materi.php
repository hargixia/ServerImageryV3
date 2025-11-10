<?php

namespace App\Http\Controllers;

use App\Models\data_materi;
use App\Models\data_materi_detail;

class api_materi extends Controller
{
    function deco($data){
        $decode = base64_decode($data);
        $arr = explode('>>',$decode);
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

    public function materi($data){
        $data = base64_decode($data);
        if($data == "m"){
            if(true){
                $materi = data_materi::all();
                $code = 1;
                $msg = "Data Materi Ditemukan";
                $res = $materi;
                return $this->retuner($code,$msg,$res);
            }else{
                $msg = "Data Materi Tidak Ditemukan";
                $res = "-";
                $code = 0;
                return $this->retuner($code,$msg,$res);
            }
        }else{
            $code = 404;
            $msg = "No Authorization";
            $res = "-";
            return $this->retuner($code,$msg,$res);
        }
    }

    public function materi_detail($data){
        $data = $this->deco($data);
        $id = $data[1];
        if($data[0] == "md" ){
            if(true){
                $materi_detail = data_materi_detail::where('id_materi',$id)->get();
                $code = 1;
                $msg = "Data Materi Detail Ditemukan";
                $res = $materi_detail;
                return $this->retuner($code,$msg,$res);
            }else{
                $code = 0;
                $msg = "Data Materi Detail Tidak Ditemukan";
                $res = "-";
                return $this->retuner($code,$msg,$res);
            }
        }else{
            $code = 404;
            $msg = "No Authorization";
            $res = "-";
            return $this->retuner($code,$msg,$res);
        }
    }

}
