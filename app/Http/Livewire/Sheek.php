<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sheek extends Component
{
    public $beneficiary_name = '';
    public $amount = 0;
    public $currany = 'Shakel';
    public $bank = 1;
    public $banks = [];
    public $country_id = 1;
    public $countries = [];
    public $desc;
    // public $image_name;

    public function mount()
    {
        $this->countries = Country::all();
    }
    public function render()
    {
        // dd($this->countries);
        $this->banks = Bank::where('country_id', $this->country_id)->get();
        $image_name = DB::table('images')->select('img')->where('bank_id', $this->bank)->first();
        // dd($this->image_name = DB::table('images')->select('img')->where('bank_id', $this->bank)->get());
        return view('livewire.sheek', [
            'image_name' => 'img/' . $image_name->img,
        ]);
    }
}
