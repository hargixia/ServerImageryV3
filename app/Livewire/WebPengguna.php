<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class WebPengguna extends Component
{
    public $pengguna;
    public $user_id;

    public function currentUser($id){
        $this->user_id = $id;
    }

    public function mount(){
        $this->pengguna = User::all();
    }

    public function render()
    {
        return view('livewire.web-pengguna');
    }
}
