<?php

namespace App\Http\Livewire;

use App\Models\Currancy;
use Livewire\Component;

class CurrancySearch extends Component
{
    public $searchTerm = '';
    
    public function render()
    {
        $currancies = Currancy::where('name', 'LIKE', '%' . $this->searchTerm . '%')->paginate();
        return view('livewire.currancy-search', ['currancies' => $currancies]);
    }
}
