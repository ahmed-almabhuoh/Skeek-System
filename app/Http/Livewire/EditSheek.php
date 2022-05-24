<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Livewire\Component;

class EditSheek extends Component
{
    // Sheek Property
    public $sheek;
    public $beneficiary_name;
    public $amount;
    public $currancy;
    public $bank;
    public $banks;
    public $country;
    public $countries;
    public $selected_country_id = 1;
    public $selected_bank_id = 1;
    public $line_type = 1;
    public $desc = '';

    public function mount()
    {
        $this->beneficiary_name = $this->sheek->beneficiary_name;
        $this->amount = $this->sheek->amount;
        $this->currancy = $this->sheek->currancy;
        $this->country = Country::where('id', $this->selected_bank_id)->first();
        $this->countries = Country::all();
        $this->line_type = $this->sheek->underline_type;
        $this->desc = $this->sheek->desc;
    }
    // public $amount;
    // public $bank_name;
    // public $currancy;
    // public $desc;
    // public $type;
    // public $sheek_id;
    // public $country;
    // public $selected_country;

    // public function mount ($sheek) {
    //     $this->sheek = $sheek;
    //     $this->beneficiary_name = $this->sheek->beneficiary_name;
    //     $this->amount = $this->sheek->amount;
    //     $this->bank_name = $this->sheek->bank_name;
    //     $this->currancy = $this->sheek->currancy;
    //     $this->desc = $this->sheek->desc;
    //     $this->type = $this->sheek->type;
    //     $this->sheek_id = $this->sheek->id;
    //     $this->country = Country::all();
    // }

    public function render()
    {
        $this->banks = Bank::where('country_id', $this->selected_country_id)->get();
        $this->bank = Bank::where('id', $this->selected_bank_id)->first();
        return view('livewire.edit-sheek');
    }
}
