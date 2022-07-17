<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use Livewire\Component;

class CountryBanksSearch extends Component
{
    public $searchTerm = '';
    public $banks;
    public $country_id;

    public function mount($country)
    {
        $this->country_id = $country->id;
    }

    public function render()
    {
        $this->banks = Bank::where([
            ['country_id', $this->country_id],
            ['admin_id', auth('admin')->user()->id],
            ['name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->get();
        return view('livewire.country-banks-search', [
            'banks' => $this->banks,
        ]);
    }
}
