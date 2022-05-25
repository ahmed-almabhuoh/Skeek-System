<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class CountrySearch extends Component
{
    public $searchTerm;
    public $countries;

    public function mount (){
        $this->countries = Country::where('admin_id', auth('admin')->user()->id)->get();
    }

    public function render()
    {
        $this->countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->withCount('banks')->get();
        return view('livewire.country-search');
    }
}
