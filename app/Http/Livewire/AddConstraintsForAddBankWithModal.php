<?php

namespace App\Http\Livewire;

use App\Models\Currancy;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddConstraintsForAddBankWithModal extends Component
{
    // public $bank_name = '';
    // public $country_id = 0;
    // public $currancy_id = 0;
    // public $city = '';
    public $countries;
    public $currancies;
    public $bank_name = '';
    public $country_id = 0;
    public $currancy_id = 0;
    public $city = '';

    public function mount($countries, $currancies)
    {
        $this->countries = $countries;
        $this->currancies = $currancies;
    }

    public function render()
    {
        $this->countries = DB::table('static_countries')->get();
        $this->currancies = Currancy::active()->get();
        return view('livewire.add-constraints-for-add-bank-with-modal');
    }
}
