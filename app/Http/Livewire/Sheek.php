<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sheek extends Component
{
    public $beneficiary_name = '';
    public $amount = 0;
    public $currany = 'Shakel';
    public function render()
    {
        return view('livewire.sheek');
    }
}
