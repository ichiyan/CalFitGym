<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Component
{

    public $current, $new, $confirm;

    public function submit(){


    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
