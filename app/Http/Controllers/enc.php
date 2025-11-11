<?php

    class enc{
        function deco($data){
            $decode = base64_decode($data);
            $arr = explode('>>',$decode);
            return $arr;
        }

        public function enco($data){
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
    }
