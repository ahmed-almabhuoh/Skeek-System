<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
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
    public $image_name;
    public $date;

    public function mount()
    {
        $this->beneficiary_name = $this->sheek->beneficiary_name;
        $this->amount = $this->sheek->amount;
        $this->currancy = $this->sheek->currancy;
        $this->country = Country::where('id', $this->selected_bank_id)->first();
        $this->countries = Country::all();
        $this->line_type = $this->sheek->underline_type;
        $this->desc = $this->sheek->desc;
        $this->selected_bank_id = $this->sheek->bank_id;
        $this->date = $this->sheek->date;
    }

    public function render()
    {
        $this->image_name = 'img/' . (DB::table('images')->select('img')->where('bank_id', $this->selected_bank_id)->first())->img;
        $this->banks = Bank::where('country_id', $this->selected_country_id)->get();
        $this->bank = Bank::where('id', $this->selected_bank_id)->first();
        return view('livewire.edit-sheek');
    }
}
