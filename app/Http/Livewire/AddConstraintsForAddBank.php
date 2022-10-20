<?php

namespace App\Http\Livewire;

use App\Models\Currancy;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddConstraintsForAddBank extends Component
{
    public $bank_name = '';
    public $country_id = 0;
    public $currancy_id = 0;
    public $city = '';

    public function render()
    {
        $this->countries = DB::table('static_countries')->get();
        $this->currancies = Currancy::where('active', true)->get();
        return view('livewire.add-constraints-for-add-bank');
    }
}
