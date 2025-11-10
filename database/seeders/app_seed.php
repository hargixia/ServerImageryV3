<?php

namespace Database\Seeders;

use App\Models\bidang;
use App\Models\data_app;
use App\Models\role;
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
                'nama' => $b
            ]);
        }

        foreach ($roles as $r) {
            role::create([
                'nama' => $r,
                'level' => $levels--
            ]);
        }
    }
}
