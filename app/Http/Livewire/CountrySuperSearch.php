<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class CountrySuperSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $countries = Country::where('name', 'LIKE', '%' . $this->searchTerm . '%')->paginate();

        return view('livewire.country-super-search', ['countries' => $countries]);
    }
}
