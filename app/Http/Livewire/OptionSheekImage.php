<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OptionSheekImage extends Component
{
    public $showFileElement = false;

    public function render()
    {
        return view('livewire.option-sheek-image');
    }

    public function showElement()
    {
        $this->showFileElement != $this->showFileElement;
    }
}
