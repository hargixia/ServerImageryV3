<?php

namespace Database\Seeders;

use App\Models\bidang;
use App\Models\data_app;
use App\Models\data_kategori;
use App\Models\role;
use App\Models\User;
use Illuminate\Database\Seeder;

class app_seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            'App 1',
            'App 2'
        ];
        $i = 3;
        foreach ($apps as $a) {
            data_app::create([
                'nama' => $a,
                'jumlah_pertanyaan' => $i++
            ]);
        }

        $bidang = [
            'Basket',
            'Sepak Bola',
            'Voli',
            'Renang',
            'Bulutangkis',
            'Tenis Meja',
            'Atletik'
        ];

        $roles = [
            'Admin',
            'Instruktur',
            'Peserta'
        ];

        $levels = count($roles);

        foreach ($bidang as $b) {
            bidang::create([
                'bidang' => $b
            ]);
        }

        foreach ($roles as $r) {
            role::create([
                'nama' => $r,
                'level' => $levels--
            ]);
        }

        $password = base64_encode(base64_encode('123'));

        User::create([
            'nama' => 'Admin Utama',
            'username' => 'admin',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'foto' => '',
            'password' => $password,
            'survey_count' => 0,
            'id_role' => 1,
            'id_bidang'=>1,
        ]);

        User::create([
            'nama' => 'peserta',
            'username' => 'peserta',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'foto' => '',
            'password' => $password,
            'survey_count' => 0,
            'id_role' => 3,
            'id_bidang'=>1,
        ]);

        $kat = [
            'Sangat Rendah',
            'Rendah',
            'Normal',
            'Tinggi',
            'Sangat Tinggi'
        ];

        $max = [
            20,
            45,
            80,
            90,
            100
        ];

        $min = 0;

        $pos = 0;
        foreach ($kat as $k) {
            data_kategori::create([
                'kategori' => $k,
                'minimal' => $min,
                'maksimal' => $max[$pos++]
            ]);
            $min = $max[$pos - 1] + 1;
        }

    }
}
