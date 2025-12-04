<?php

use App\Http\Controllers\api_auth;
use App\Http\Controllers\api_materi;
use App\Http\Controllers\api_kuisoner;
use App\Http\Controllers\api_perkembangan;
use App\Livewire\WebAkun;
use App\Livewire\WebDashboard;
use App\Livewire\WebKuisonerTambah;
use App\Livewire\WebKuisonerTes;
use App\Livewire\WebLogin;
use App\Livewire\WebMateri;
use App\Livewire\WebMateriDetail;
use App\Livewire\WebMateriDetailTambah;
use App\Livewire\WebMateriDetailTampil;
use App\Livewire\WebPengguna;
use App\Livewire\WebPenggunaPage;
use App\Livewire\WebPerkembangan;
use App\Livewire\WebPerkembanganList;
use App\Livewire\WebRegister;
use App\Livewire\WebTugas;
use App\Livewire\WebTugasList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

route::get('/login',WebLogin::class)->name('login');
route::get('/register',WebRegister::class)->name('register');

route::middleware('auth')->group(function(){
    route::get('/dashboard',WebDashboard::class);
    route::get('/materi',WebMateri::class);

    route::get('/materi/detail/{id}',WebMateriDetail::class);
    route::get('/materi/detail/{id}/tambah',WebMateriDetailTambah::class);
    route::get('/materi/detail/{id}/kuisoner',WebKuisonerTambah::class);

    route::get('/materi/detail/{id}/tampil/{idmd}',WebMateriDetailTampil::class);
    route::get('/materi/{id}/t/{mode}',WebKuisonerTes::class);
    route::get('/materi/detail/{id}/perkembangan',WebPerkembanganList::class);
    route::get('/materi/detail/{id}/perkembangan/d/{idu}',WebPerkembangan::class);

    route::get('/materi/detail/{id}/tugas/{data}',WebTugas::class);
    route::get('/materi/detail/{id}/tugas',WebTugasList::class);

    route::get('/pengguna',WebPengguna::class);
    route::get('/pengguna/d/{data}',WebPenggunaPage::class);
    route::get('pengaturan-akun',WebAkun::class);

    route::get('/logout', [WebLogin::class, 'logout']);
});

route::get('/api/login/{data}',[api_auth::class , 'login']);
route::get('/api/register/{data}',[api_auth::class , 'register']);
route::get('/api/materi/{data}',[api_materi::class , 'materi']);
route::get('/api/materi_detail/{data}',[api_materi::class , 'materi_detail']);
route::get('/api/kuisoner_cek/{data}',[api_kuisoner::class , 'kuisoner_cek']);
route::get('/api/kuisoner_pertanyaan/{data}',[api_kuisoner::class , 'kuisoner_pertanyaan']);
route::get('/api/kuisoner_jawab/{data}',[api_kuisoner::class , 'kuisoner_jawab']);

route::get('/api/perkembangan/{data}',[api_perkembangan::class,'perkembangan_user']);
