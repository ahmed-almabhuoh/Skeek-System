<?php

namespace App\Http\Livewire;

use App\Models\Sheek;
use Livewire\Component;

class SearchSheek extends Component
{
<<<<<<< HEAD
    public $searchTerm;
=======
    // public $searchTerm;

    public $searchTerm = null;
>>>>>>> 0fcda399259e05067193472199dd5cf0298ef286
    public $sheeks;

    public function render()
    {
        $this->sheeks = Sheek::where('beneficiary_name', 'LIKE', '%' . $this->searchTerm . '%')->get();
        return view('livewire.search-sheek');
    }
}
