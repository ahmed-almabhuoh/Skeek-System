<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddStaticCountryWithDisableSubmittion extends Component
{
    public $country_name = null;


    public function render()
    {
        return view('livewire.add-static-country-with-disable-submittion');
    }
}
