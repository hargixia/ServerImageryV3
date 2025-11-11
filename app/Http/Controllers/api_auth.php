<?php

namespace App\Http\Controllers;

use App\Http\Controllers\enc;
use App\Models\User;
use Exception;

class api_auth extends Controller
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

    public function login($data)
    {

        $arr = $this->deco($data);

        if($arr[0] == "Login"){
            $user   = User::where('username',$arr[1])->get()->first();
            if($user == null){
                $code = 0;
                $res = "Login Gagal>>User Tidak Ditemukan";
            }else{
                $pass   = base64_decode($user->password);
                $passin = base64_encode($arr[2]);

                if($passin == $pass){
                    $sid    = $user->id;
                    $sc     = $user->survey_count;
                    $sm     = 3;
                    if($sc >= $sm){
                        $code = 1;
                        User::where('id',$sid)->update(['survey_count'=>0]);
                    }else{
                        $code = 2;
                        $sc += 1;
                        User::where('id',$sid)->update(['survey_count'=>$sc]);
                    }
                    $res = "Login Berhasil>>" . json_encode($user);;
                }else{
                    $code = 0;
                    $res = "Login Gagal>>-";
                }
            }
        }else{
            $code = 404;
            $res = "Login Gagal>>Tidak Ditemukan";
        }

        $data = [
            'status'        => $code,
            'data'          => $this->enco($res)
        ];
        echo json_encode(array($data));
    }

    public function register($data){
        $arr = $this->deco($data);

        if($arr[0] == "Register"){
            $existingUser = User::where('username',$arr[1])->first();
            if($existingUser){
                $code = 1;
                $res = "Register Gagal>>username telah ada";
            }else{
                $tgl = strtotime($arr[3]);
                $tgl_lahir = date('Y-m-d',$tgl);
                $password = base64_encode($arr[6]);

                try{
                    $parcel = User::create([
                        'username'      => $arr[1],
                        'nama'          => $arr[2],
                        'tanggal_lahir' => $tgl_lahir,
                        'jenis_kelamin' => $arr[4],
                        'id_bidang'     => $arr[5],
                        'password'      => base64_encode($password),
                    ]);
                    if($parcel){
                        $code = 0;
                        $res = "Register Berhasil>>" . json_encode($parcel);
                    }
                }catch(Exception $e){
                    $code = 1;
                    $res = "Register Gagal>>" . $e;
                }

            }
        }else{
            $code = 404;
            $res = "Register Gagal>>Tidak Ditemukan";
        }

        $data = [
            'status'        => $code,
            'data'          => $this->enco($res)
        ];
        echo json_encode($data);
    }
}
