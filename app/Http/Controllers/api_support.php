<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class api_support extends Controller
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

    function splitterv2($data){
        $arr = explode('--',$data);
        return $arr;
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
}
