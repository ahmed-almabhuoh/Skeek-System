<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchForPaidSheek extends Component
{
    public $searchTerm;
    public $sheeks;

    public function mount () {
        $this->sheeks = \App\Models\Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'LIKE', 'paid'],
//            ['beneficiary_name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->get();
    }

    public function render()
    {
        $this->sheeks = \App\Models\Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'LIKE', 'paid'],
            ['beneficiary_name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->get();
        return view('livewire.search-for-paid-sheek');
    }
}
