<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

class WebDashboard extends Component
{

    #[Title('Dashboard')]

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->to('/login');
    }

    public function render()
    {
        return view('livewire.web-dashboard');
    }
}
