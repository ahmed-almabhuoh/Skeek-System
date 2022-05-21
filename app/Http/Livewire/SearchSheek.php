<?php

namespace App\Http\Livewire;

use App\Models\Sheek;
use Livewire\Component;

class SearchSheek extends Component
{
    public $searchTerm;
    public $sheeks;

    public function render()
    {
        $this->sheeks = Sheek::where('beneficiary_name', 'LIKE', '%' . $this->searchTerm . '%')->get();
        return view('livewire.search-sheek');
    }
}
