<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddConstraintsForCurrancyWithModal extends Component
{
    public $name = '';
    
    public function render()
    {

        return view('livewire.add-constraints-for-currancy-with-modal');
    }
}
