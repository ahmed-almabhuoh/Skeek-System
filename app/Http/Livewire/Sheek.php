<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Livewire\Component;

class Sheek extends Component
{
    public $beneficiary_name = '';
    public $amount = 0;
    public $currany = 'Shakel';
    public $bank = 0;
    public $banks = [];
    public $country_id = 1;
    public $countries = [];
    public $desc;

    public function mount()
    {
        $this->countries = Country::all();
    }
    public function render()
    {
        // dd($this->countries);
        $this->banks = Bank::where('country_id', $this->country_id)->get();
        return view('livewire.sheek');
    }
}
