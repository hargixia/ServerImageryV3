<?php

namespace App\Livewire;

use App\Models\bidang;
use Livewire\Component;

use App\Models\data_app;

use App\Models\data_materi;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class WebMateri extends Component
{
    #[Title('Daftar Materi')]

    public $app;
    public $FilterMateriVal = 0;
    public $textList = [
        'Semua Aplikasi',
    ];
    public $FilterMateriText = '';
    public $data_materi;
    public $data_bidang;

    #[Validate('required')]
    public $judul;
    public $deskripsi;
    public $id_app;
    public $id_bidang;

    public $user_edit = false;

    public function filterMateri($value){
        $this->FilterMateriVal = $value;
        $this->FilterMateriText = $this->textList[$this->FilterMateriVal];
        $this->data_materi = data_materi::when($this->FilterMateriVal != 0, function($query){
            $query->where('id_apps', $this->FilterMateriVal);
        })->get();
    }

    public function tambahMateri(){
        $materi = new data_materi();
        $materi->judul = $this->judul;
        $materi->deskripsi = $this->deskripsi;
        $materi->id_apps = $this->id_app;
        $materi->id_bidangs = $this->id_bidang;
        $materi->id_authors = Auth::user()->id;
        $materi->save();

        session()->flash('success', 'Penambahan Materi Berhasil.');
        return redirect('/materi');
    }

    public function mount(){
        $this->user_edit = session('user_edit', false);
        $this->textList = [
            'Semua Aplikasi',
        ];
        $this->app = data_app::all();
        foreach($this->app as $a){
            array_push($this->textList,$a->nama);
        }

        $this->data_materi = data_materi::all();
        $this->data_bidang = bidang::all();
    }

    public function hapusMateri($id){
        data_materi::where('id',$id)->delete();
        return redirect('/materi');
    }

    public function render()
    {
        $this->FilterMateriText = $this->textList[$this->FilterMateriVal];
        return view('livewire.web-materi');
    }
}
