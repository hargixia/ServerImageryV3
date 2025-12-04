<?php

namespace App\Livewire;

use App\Models\kuisoner_pertanyaan;
use App\Models\data_app;
use App\Models\data_materi;

use Livewire\Component;
use Livewire\Attributes\Title;

use App\Http\Controllers\api_kuisoner;

use Illuminate\Support\Facades\Auth;

class WebKuisonerTes extends Component
{
    #[Title('Kuisoner Tes')]

    public $id;
    public $mode;
    public $kuisoner;
    public $materi;
    public $app_opsi;

    public $opsiList = [
        'Sangat Setuju',
        'Setuju',
        'Netral',
        'Tidak Setuju',
        'Sangat Tidak Setuju',
    ];

    public $opsi =[];
    public $jawaban = [];

    public $kirim = "";
    public $nilai = 0;
    public $rekomendasi = "";
    public $kategori = "";

    public function mount(){
        $this->materi = data_materi::find($this->id);
        $this->app_opsi = data_app::find($this->materi->id_apps);
        $this->kuisoner = kuisoner_pertanyaan::where('id_materi',$this->id)->orderBy('no','asc')->get();
        if($this->app_opsi->jumlah_pertanyaan == 4){
            $this->opsi = [
                'Sangat Tidak Setuju',
                'Tidak Setuju',
                'Netral',
                'Setuju',
                'Sangat Setuju',
            ];
        }else{
            $this->opsi = [
                'Tidak Setuju',
                'Netral',
                'Setuju',
            ];
        }
        for($i=0; $i < count($this->kuisoner); $i++) {
            array_push($this->jawaban, ['id_pertanyaan' => $this->kuisoner[$i]->id,'no'=>$this->kuisoner[$i]->no, 'value' => '']);
        }
    }

    public function kembali(){
        return redirect('/materi/detail/'.$this->id);
    }

    public function render()
    {
        return view('livewire.web-kuisoner-tes');
    }

    public function jawab($id,$val){
        $id = $id - 1;
        $this->jawaban[$id] = ['id_pertanyaan' => $this->kuisoner[$id]->id,'no'=>$this->kuisoner[$id]->no, 'value' => $val];
    }

    public function kirimJawaban(){
        $api = new api_kuisoner();
        $jawab_kirim = "";

        for($i=0; $i < count($this->jawaban); $i++) {
            $adder = ">>";
            if($i >= count($this->jawaban)-1){
                $adder = "";
            }
            $jawab_kirim = $jawab_kirim . $this->jawaban[$i]['id_pertanyaan'] . "--" . $this->jawaban[$i]['value'] . $adder;
        }

        $sender = "kj>>" . $this->id . ">>" . Auth::user()->id . ">>" . $this->mode . ">>" . $jawab_kirim;
        $data = json_decode($api->kuisoner_jawab(base64_encode($sender)))[0];
        $this->kirim = json_encode($data);
        $this->nilai = json_encode($data->res[0]->nilai);
        $this->rekomendasi = json_encode($data->res[0]->rekomendasi);
        $this->kategori = json_encode($data->res[0]->kategori);
    }
}
