<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;
use SebastianBergmann\CodeUnit\FunctionUnit;

class WebMateriTest extends Component
{
    #[Title('Kuisoner')]
    public $id;

    public Function mount(){
        
    }

    public function render()
    {
        return view('livewire.web-materi-test');
    }
}
