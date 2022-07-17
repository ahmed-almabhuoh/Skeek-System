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
    public $amount_in_word;
    // public $currancy = 'Shakel';
    public $bank;
    public $banks;
    public $country;
    public $currancy;
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
        $this->countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', 1],
        ])->get();
        $this->line_type = $this->sheek->underline_type;
        $this->desc = $this->sheek->desc;
        $this->selected_bank_id = $this->sheek->bank_id;
        $this->date = $this->sheek->date;
    }

    public function another()
    {
        if ($this->amount == '')
            $this->amount = 1;

        $Arabic = new \ArPHP\I18N\Arabic();

        $Arabic->setNumberFeminine(1);
        $Arabic->setNumberFormat(1);

        $integer = $this->amount;

        $text = $Arabic->int2str($integer);

        if ($this->currancy == 'Shakel') {
            $text = 'فقط ' . $text . ' شيكل لا غير';
        } else if ($this->currancy == 'Dollar') {
            $text = 'فقط ' . $text . ' دولار لا غير';
        } else {
            $text = 'فقط ' . $text . ' دينار لا غير';
        }

        return $text;
    }

    public function render()
    {
        $this->amount_in_word = $this->another();
        $this->image_name = 'img/' . (DB::table('images')->select('img')->where('bank_id', $this->selected_bank_id)->first())->img;
        $this->banks = Bank::where('country_id', $this->selected_country_id)->get();
        $this->bank = Bank::where('id', $this->selected_bank_id)->first();
        return view('livewire.edit-sheek');
    }
}
