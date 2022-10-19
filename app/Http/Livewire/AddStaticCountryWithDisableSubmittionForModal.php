<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddStaticCountryWithDisableSubmittionForModal extends Component
{
    public $static_country_name = '';

    public function render()
    {
        return view('livewire.add-static-country-with-disable-submittion-for-modal');
    }
}
