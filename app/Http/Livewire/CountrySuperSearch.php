<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CountrySuperSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $countries = DB::table('static_countries')->where('name', 'LIKE', '%' . $this->searchTerm . '%')->paginate();

        return view('livewire.country-super-search', ['countries' => $countries]);
    }
}
