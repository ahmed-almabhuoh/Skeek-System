<?php

namespace App\Http\Livewire;

use App\Models\Super;
use Livewire\Component;

class SuperSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $supers = Super::where('name', 'LIKE', '%' . $this->searchTerm . '%')->get();
        return view('livewire.super-search', ['supers' => $supers]);
    }
}
