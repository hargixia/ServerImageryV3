<?php

namespace App\Livewire;

use Livewire\Component;

class CardUsers extends Component
{

    public $val1 = 0;

    public function render()
    {
        return view('livewire.card-users');
    }

    public function mount()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->val1 += $i;
        }
    }
}
